<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>EasyColoc Invitation</title>
</head>
<body style="background-color: #f8fafc; font-family: sans-serif; padding: 40px 10px;">
    
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; background-color: #ffffff; border-radius: 24px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        
        <tr>
            <td style="padding: 30px; text-align: center; background-color: #ffffff; border-bottom: 1px solid #f1f5f9;">
                <div style="display: inline-block; background-color: #2563eb; padding: 10px; border-radius: 12px; margin-right: 10px; vertical-align: middle;">
                    <span style="color: white; font-weight: 900; font-size: 20px;">E</span>
                </div>
                <span style="font-size: 24px; font-weight: 900; color: #0f172a; letter-spacing: -1px; vertical-align: middle;">
                    Easy<span style="color: #2563eb;">Coloc</span>
                </span>
            </td>
        </tr>

        <tr>
            <td style="padding: 40px 30px;">
                <h2 style="margin: 0 0 20px; font-size: 22px; font-weight: 800; color: #0f172a;">You're Invited!</h2>
                
                <p style="margin: 0 0 15px; font-size: 16px; color: #475569; line-height: 1.6;">
                    Hello, <br>
                    You have been invited to join a colocation. Managing your shared expenses and tasks just got a lot easier.
                </p>

                <div style="margin: 30px 0; padding: 20px; background-color: #f1f5f9; border-radius: 16px; border: 2px dashed #cbd5e1; text-align: center;">
                    <p style="margin: 0 0 8px; font-size: 12px; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 1px;">Your Invitation Token</p>
                    <span style="font-size: 28px; font-weight: 900; color: #0f172a; letter-spacing: 4px; font-family: monospace;">
                        {{ $invitation->token }}
                    </span>
                </div>

                <div style="text-align: center; margin-top: 30px;">
                    <a href="{{ route('invitations.accept.link', $invitation->token) }}" 
                       style="background-color: #0f172a; color: #ffffff; padding: 16px 35px; border-radius: 14px; text-decoration: none; font-weight: 800; font-size: 14px; display: inline-block; box-shadow: 0 10px 15px -3px rgba(15, 23, 42, 0.2);">
                        ACCEPT INVITATION
                    </a>
                </div>

                <p style="margin: 35px 0 0; font-size: 13px; color: #94a3b8; text-align: center;">
                    If the button doesn't work, go to the "Join" page and paste the token manually.
                </p>
            </td>
        </tr>

        <tr>
            <td style="padding: 20px; background-color: #f8fafc; text-align: center; border-top: 1px solid #f1f5f9;">
                <p style="margin: 0; font-size: 12px; color: #94a3b8; font-weight: 600;">
                    © 2026 EasyColoc. All rights reserved.
                </p>
            </td>
        </tr>
    </table>

</body>
</html>