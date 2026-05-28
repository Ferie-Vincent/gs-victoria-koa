<?php
/**
 * Script de déploiement FTP — GS VICTORIA-KOA
 * ─────────────────────────────────────────────
 * À uploader dans public/ via FTP, visiter UNE FOIS, puis supprimer.
 * URL : https://votre-domaine.ci/deploy.php?token=VOTRE_TOKEN
 */

// ─── TOKEN DE SÉCURITÉ ─────────────────────────────────────────────────────
// Changez cette valeur AVANT d'uploader. URL : ?token=CHANGEZ_MOI
define('SECRET_TOKEN', 'CHANGEZ_MOI_AVANT_UPLOAD');

if (!isset($_GET['token']) || !hash_equals(SECRET_TOKEN, $_GET['token'])) {
    http_response_code(403);
    die('Accès refusé. Ajoutez ?token=VOTRE_TOKEN à l\'URL.');
}

$publicDir = __DIR__;
$rootDir   = dirname(__DIR__);
$results   = [];

// ─── 1. Storage link (optionnel sur ce projet) ──────────────────────────────
// Les uploads d'actualités vont dans public/images/actualites/ directement.
// Le storage:link n'est nécessaire que si vous utilisez Storage::disk('public').
$storageLink = $publicDir . '/storage';
if (is_link($storageLink)) {
    $results[] = ['ok', 'storage:link', 'Lien existant → ' . readlink($storageLink)];
} elseif (is_dir($storageLink)) {
    $results[] = ['ok', 'storage:link', 'Dossier public/storage existe déjà (répertoire physique).'];
} else {
    // Tentative symlink
    $linked = @symlink('../storage/app/public', $storageLink)
           || @symlink($rootDir . '/storage/app/public', $storageLink);

    if ($linked) {
        $results[] = ['ok', 'storage:link', 'Lien symbolique créé ✓'];
    } else {
        // Fallback Plesk : créer un vrai répertoire public/storage
        // Les futurs uploads via Storage::disk('public') y seront physiquement copiés.
        if (@mkdir($storageLink, 0775, true)) {
            // Copie des fichiers existants depuis storage/app/public vers public/storage
            $src = $rootDir . '/storage/app/public';
            $copied = 0;
            if (is_dir($src)) {
                foreach (new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator($src, RecursiveDirectoryIterator::SKIP_DOTS),
                    RecursiveIteratorIterator::SELF_FIRST
                ) as $item) {
                    $dest = $storageLink . '/' . substr($item->getRealPath(), strlen($src) + 1);
                    if ($item->isDir()) {
                        @mkdir($dest, 0775, true);
                    } else {
                        @copy($item->getRealPath(), $dest) && $copied++;
                    }
                }
            }
            $results[] = ['warn', 'storage:link',
                "symlink() bloqué par Plesk → répertoire physique créé à la place ($copied fichier(s) copié(s)). " .
                "Pour ce projet, les uploads vont dans public/images/ donc pas de problème."
            ];
        } else {
            $results[] = ['warn', 'storage:link',
                'symlink() bloqué et mkdir() échoué. Ce projet stocke les images dans public/images/ donc ce point est non-bloquant.'
            ];
        }
    }
}

// ─── 2. Créer les dossiers d'images uploads ────────────────────────────────
$uploadDirs = [
    'images/actualites',
    'images/gallery',
    'documents/fournitures',
    'documents/inscriptions',
    'documents/calendrier',
];
foreach ($uploadDirs as $d) {
    $path = $publicDir . '/' . $d;
    if (!is_dir($path)) {
        @mkdir($path, 0775, true);
        $results[] = ['ok', 'mkdir', "Créé : public/$d"];
    } else {
        $w = is_writable($path);
        $results[] = [$w ? 'ok' : 'fail', 'permissions', "public/$d : " . ($w ? 'writable ✓' : 'NON writable — chmod 775')];
    }
}

// ─── 3. Dossiers framework Laravel ─────────────────────────────────────────
$fwDirs = [
    'storage/app',
    'storage/app/public',
    'storage/framework/cache',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs',
    'bootstrap/cache',
];
foreach ($fwDirs as $d) {
    $path = $rootDir . '/' . $d;
    if (!is_dir($path)) {
        @mkdir($path, 0775, true);
        $results[] = ['ok', 'mkdir', "Créé : $d"];
    } else {
        $w = is_writable($path);
        $results[] = [$w ? 'ok' : 'fail', 'permissions', "$d : " . ($w ? 'writable ✓' : 'NON writable — chmod 775 via cPanel')];
    }
}

// ─── 4. Vider les caches compilés ──────────────────────────────────────────
$cacheFiles = array_merge(
    glob($rootDir . '/bootstrap/cache/*.php') ?: [],
    glob($rootDir . '/storage/framework/views/*.php') ?: []
);
$cleared = 0;
foreach ($cacheFiles as $f) {
    if (@unlink($f)) $cleared++;
}
$results[] = ['ok', 'cache:clear', "$cleared fichier(s) de cache supprimé(s)"];

// ─── 5. Vérification .env ──────────────────────────────────────────────────
$envPath = $rootDir . '/.env';
if (!file_exists($envPath)) {
    $results[] = ['fail', '.env', '.env introuvable — créez-le depuis .env.example.'];
} else {
    $env = file_get_contents($envPath);
    $checks = [
        'APP_ENV=production' => strpos($env, 'APP_ENV=production') !== false,
        'APP_DEBUG=false'    => strpos($env, 'APP_DEBUG=false') !== false,
        'APP_KEY=base64:'    => strpos($env, 'APP_KEY=base64:') !== false,
        'MAIL_MAILER défini' => preg_match('/MAIL_MAILER=\w+/', $env),
    ];
    foreach ($checks as $label => $ok) {
        $results[] = [$ok ? 'ok' : 'warn', '.env', $label . ($ok ? ' ✓' : ' ✗ — à corriger')];
    }
}

// ─── 6. Infos serveur ──────────────────────────────────────────────────────
$results[] = ['ok', 'serveur', 'PHP ' . PHP_VERSION . ' — ' . PHP_OS];
$results[] = [function_exists('symlink') ? 'ok' : 'warn', 'symlink()', function_exists('symlink') ? 'disponible' : 'désactivé (Plesk/mutualisé) — voir note ci-dessus'];

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Deploy — GS VICTORIA-KOA</title>
<style>
  *{box-sizing:border-box}
  body{font-family:system-ui,sans-serif;background:#f5f3ff;color:#1e1b4b;margin:0;padding:24px}
  .card{background:#fff;border-radius:14px;padding:28px;max-width:740px;margin:0 auto;box-shadow:0 4px 28px #7c3aed18}
  h1{color:#7c3aed;margin:0 0 4px;font-size:1.25rem}
  .sub{color:#6b7280;font-size:.85rem;margin-bottom:20px}
  table{width:100%;border-collapse:collapse;font-size:.85rem}
  th{text-align:left;padding:9px 12px;background:#f5f3ff;color:#6d28d9;border-bottom:2px solid #ede9fe;white-space:nowrap}
  td{padding:8px 12px;border-bottom:1px solid #f3f4f6;vertical-align:top}
  .b{display:inline-block;padding:2px 9px;border-radius:99px;font-size:.72rem;font-weight:700;white-space:nowrap}
  .ok  {background:#dcfce7;color:#16a34a}
  .warn{background:#fef9c3;color:#a16207}
  .fail{background:#fee2e2;color:#dc2626}
  .note{margin-top:20px;background:#fef2f2;border:1px solid #fecaca;border-radius:10px;padding:14px 18px;color:#991b1b;font-size:.85rem;line-height:1.6}
  code{background:#f3f4f6;padding:1px 5px;border-radius:4px;font-size:.8rem}
</style>
</head>
<body>
<div class="card">
  <h1>🚀 Déploiement — GS VICTORIA-KOA</h1>
  <p class="sub">Exécuté le <?= date('d/m/Y à H:i:s') ?></p>
  <table>
    <tr><th>Statut</th><th>Action</th><th>Résultat</th></tr>
    <?php foreach ($results as [$status, $action, $message]): ?>
    <tr>
      <td><span class="b <?= $status ?>"><?= strtoupper($status) ?></span></td>
      <td><code><?= htmlspecialchars($action) ?></code></td>
      <td><?= htmlspecialchars($message) ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
  <div class="note">
    ⚠️ <strong>Supprimez <code>deploy.php</code> via FTP immédiatement après utilisation.</strong><br>
    Laisser ce fichier accessible en ligne est un risque de sécurité.
  </div>
</div>
</body>
</html>
