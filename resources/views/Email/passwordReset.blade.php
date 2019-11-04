@component('mail::message')
#

เราได้รับคำขอให้รีเซ็ตรหัสผ่านของคุณ<br>
กรุณากดปุ่มด้านล่างเพื่อรีเซ็ตรหัสผ่านต่อไปนี้ : <br><br><br>



@component('mail::button', ['url' => 'http://localhost:4200/resetPassword/'.$token])
Reset Password
@endcomponent

ขอบคุณ,<br>kb-tutor
@endcomponent
