NEXORA WEBSITE - LOCAL SMTP SETUP (XAMPP + GMAIL)
=================================================

FILES
- Replace your existing index.html with index_smtp.html (rename it to index.html).
- Replace your existing contact.html with contact_smtp.html (rename it to contact.html).
- Put send-email.php, composer.json, and .htaccess in the same website folder.
- Copy smtp-config.example.php to smtp-config.php.

1) GMAIL APP PASSWORD
- Sign in to the Google account that will send the messages.
- Enable 2-Step Verification.
- Create a Google App Password for this website.
- Put the 16-character App Password in smtp-config.php at SMTP_APP_PASSWORD.
- Do NOT use your normal Gmail password. Do NOT share the App Password.

2) INSTALL PHPMailer
- Install Composer if it is not installed.
- Open Command Prompt in the website folder (the folder containing composer.json).
- Run: composer install
- This creates the vendor folder required by send-email.php.

3) RUN ON XAMPP
- Install/start Apache in XAMPP.
- Put the complete website folder inside C:\xampp\htdocs\IT_WEBSITE3\
- Open: http://localhost/IT_WEBSITE3/index.html
- Do not open the file using file:///C:/...; PHP needs Apache to run.

4) TEST
- Submit the homepage form and contact page form.
- The messages should arrive at bansinakum2@gmail.com.
- If sending fails, check Apache/PHP error logs and verify the App Password, Gmail 2-Step Verification, and Composer vendor folder.

SMTP DETAILS
Host: smtp.gmail.com
Port: 587
Encryption: STARTTLS
Sender account: bansinakum2@gmail.com
Recipient: bansinakum2@gmail.com

SECURITY
- Keep smtp-config.php private; never put the App Password in HTML or JavaScript.
- Keep .htaccess in the website root. On a public server, use HTTPS and server-side rate limiting/spam protection.
- This setup is for a PHP-enabled server such as XAMPP. Static-only hosting such as GitHub Pages cannot run this PHP endpoint.
