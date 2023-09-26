#!/usr/bin/expect

set username "mathieucaudan"
set password "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"  ;# Remplacez par votre mot de passe GitHub
set commit_message "maj"

# Exécutez la commande git add *
spawn git add *

# Exécutez la commande git commit -m "maj"
spawn git commit -m "$commit_message"

# Exécutez la commande git push
spawn git push

# Attendez que le programme demande le nom d'utilisateur
expect "Username for 'https://github.com':"

# Répondez avec le nom d'utilisateur
send "$username\r"

# Attendez que le programme demande le mot de passe
expect "Password for 'https://$username@github.com':"

# Répondez avec le mot de passe
send "$password\r"

# Attendez la fin du programme
expect eof
