# ProjectEvidenceNette

Zkušební aplikace v nette frameworku.
Dump databáze se nachází ve složce `database`

```
<VirtualHost *:80>
    ServerName nette.localhost
    DocumentRoot "C:/xampp72/htdocs/ProjectEvidenceNette/www"
    ErrorLog "error_cheers24.log"

    <Directory "C:/xampp72/htdocs/ProjectEvidenceNette/www">
        RewriteEngine On
        Options Indexes Multiviews FollowSymLinks
        AllowOverride All
        Allow from all
        Require all granted
    </Directory>
</VirtualHost>
```