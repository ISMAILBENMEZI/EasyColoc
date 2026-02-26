<p>Hello,</p>

<p>You have been invited to join a colocation on EasyColoc.</p>

<p><strong>Token:</strong> {{ $invitation->token }}</p>

<p>Click this link to accept:</p>

<p>
    <a href="{{ route('invitations.accept.link', $invitation->token) }}">
        Accept Invitation
    </a>
</p>

<p>If the link does not work, you can also join manually by going to Join page and pasting the token.</p>

<p>Thanks,<br>EasyColoc</p>
