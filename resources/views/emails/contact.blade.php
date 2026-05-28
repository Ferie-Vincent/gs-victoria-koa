<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau message — GS VICTORIA-KOA</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f3f4f6;">
    <div style="max-width: 600px; margin: 0 auto;">

        {{-- Header --}}
        <div style="background: linear-gradient(135deg, #7C3AED, #1E1B4B); padding: 28px 24px; border-radius: 12px 12px 0 0;">
            <h1 style="color: white; margin: 0; font-size: 20px; font-weight: bold;">GS VICTORIA-KOA</h1>
            <p style="color: #E9D5FF; margin: 6px 0 0; font-size: 14px;">Nouveau message depuis le site web</p>
        </div>

        {{-- Body --}}
        <div style="background: #ffffff; padding: 28px 24px; border-radius: 0 0 12px 12px; border: 1px solid #e5e7eb; border-top: none;">

            <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                <tr>
                    <td style="padding: 10px 0; border-bottom: 1px solid #f3f4f6; color: #6b7280; font-size: 13px; width: 120px;">Nom</td>
                    <td style="padding: 10px 0; border-bottom: 1px solid #f3f4f6; font-weight: bold; color: #111827;">{{ $data['name'] }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px 0; border-bottom: 1px solid #f3f4f6; color: #6b7280; font-size: 13px;">Email</td>
                    <td style="padding: 10px 0; border-bottom: 1px solid #f3f4f6; color: #7C3AED;">
                        <a href="mailto:{{ $data['email'] }}" style="color: #7C3AED;">{{ $data['email'] }}</a>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px 0; border-bottom: 1px solid #f3f4f6; color: #6b7280; font-size: 13px;">Téléphone</td>
                    <td style="padding: 10px 0; border-bottom: 1px solid #f3f4f6; color: #111827;">
                        {{ $data['phone'] ?? 'Non renseigné' }}
                    </td>
                </tr>
            </table>

            <p style="color: #374151; font-weight: bold; margin-bottom: 10px; font-size: 14px;">Message :</p>
            <div style="background: #f9fafb; padding: 16px 20px; border-radius: 10px; border-left: 4px solid #7C3AED; color: #374151; line-height: 1.6; white-space: pre-wrap;">{{ $data['message'] }}</div>

            <p style="color: #9ca3af; font-size: 12px; margin-top: 24px; padding-top: 16px; border-top: 1px solid #f3f4f6;">
                Envoyé le {{ now()->format('d/m/Y à H:i') }} via le formulaire de contact du site GS VICTORIA-KOA
            </p>
        </div>

    </div>
</body>
</html>
