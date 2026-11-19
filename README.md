# 🩺 TP — Calculateur d'IMC (Partie B : Base de données & PHP/PDO)
**ISTMT · Université de Tunis El Manar** — *Dr Marwa Ben Ammar*

Bienvenue dans l'équipe technique du centre de nutrition ! Votre mission : connecter l'interface Web existante à une base de données MySQL pour sauvegarder et sécuriser l'historique des patients.

---

## 🚀 Mise en route (5 min)
- [ ] Cliquer sur **Use this template** > **Create a new repository** (nommez-le `tp-imc-votreNom`).
- [ ] Cloner votre dépôt dans le dossier `C:\xampp\htdocs\`.
- [ ] Démarrer **Apache** et **MySQL** dans le panneau de contrôle XAMPP.
- [ ] Tester l'affichage sur `http://localhost/tp-imc-votreNom/index.php`.

---

## 🏁 Sprint 1 : Base de données & SQL (30 min)

### Exercice 5 — Concevoir la base avec phpMyAdmin

> **Objectif :** concevoir et créer une base de données relationnelle (2 tables, clé primaire, clé étrangère).

#### Travail demandé

- [ ] **1.** Dans **phpMyAdmin** (`http://localhost/phpmyadmin`), créez la base `imc_db` avec l'interclassement `utf8mb4_general_ci`.

- [ ] **2.** Créez la table `personne` :

| Champ | Type | Contraintes |
| :--- | :--- | :--- |
| `id` | `INT` | Clé primaire, auto-incrément |
| `nom` | `VARCHAR(50)` | `NOT NULL` |
| `prenom` | `VARCHAR(50)` | `NOT NULL` |

- [ ] **3.** Créez la table `mesure` (moteur **InnoDB**) :

| Champ | Type | Contraintes |
| :--- | :--- | :--- |
| `id` | `INT` | Clé primaire, auto-incrément |
| `personne_id` | `INT` | `NOT NULL`, clé étrangère vers `personne(id)` |
| `poids` | `DECIMAL(5,1)` | `NOT NULL` |
| `taille` | `DECIMAL(3,2)` | `NOT NULL` |
| `imc` | `DECIMAL(4,1)` | `NOT NULL` |
| `categorie` | `VARCHAR(20)` | `NOT NULL` |
| `date_mesure` | `DATETIME` | Valeur par défaut : date et heure courantes (`CURRENT_TIMESTAMP`) |

- [ ] **4.** Définissez la clé étrangère `mesure.personne_id → personne.id` (onglet **« Vue relationnelle »**) avec l'action `ON DELETE CASCADE`, puis ouvrez le **« Concepteur »** pour vérifier le schéma.

- [ ] **5.** Insérez les données de test ci-dessous, puis exportez la structure et les données dans le fichier `imc_db.sql` à la racine du projet.

#### Données à insérer

| Table | Valeurs |
| :--- | :--- |
| `personne` | `('Ben Salah', 'Amine')` ; `('Trabelsi', 'Sana')` ; `('Gharbi', 'Youssef')` |
| `mesure` | **Personne 1 :** `72.5` kg, `1.75` m, `23.7`, `'Normal'`<br>**Personne 1 :** `80.0` kg, `1.75` m, `26.1`, `'Surpoids'`<br>**Personne 2 :** `52.0` kg, `1.68` m, `18.4`, `'Sous-poids'`<br>**Personne 2 :** `58.0` kg, `1.68` m, `20.5`, `'Normal'`<br>**Personne 3 :** `95.0` kg, `1.72` m, `32.1`, `'Obésité'` |

---

### Exercice 6 — Requêtes SQL (`requetes.sql`)
- [ ] Écrire et tester la requête d'**insertion** d'une mesure dans `requetes.sql`.
- [ ] Écrire et tester la requête de **jointure** (historique trié du plus récent au plus ancien).
- [ ] Écrire et tester la requête d'**agrégation** (nombre de mesures et IMC moyen par patient).
- [ ] **Git Push #1 :** `git add . && git commit -m "feat: creation base et requetes SQL" && git push`

---

## 🔌 Sprint 2 : Connexion PHP / PDO (40 min)

### Exercice 7 — Rendre l'application dynamique
- [ ] Compléter `connexion.php` pour établir la connexion PDO à `imc_db`.
- [ ] Compléter `index.php` pour charger les patients dans le `<select>` et afficher l'historique dans le `<table>`.
- [ ] Compléter `ajouter.php` pour calculer l'IMC côté serveur, insérer la mesure et rediriger vers `index.php`.
- [ ] Compléter `supprimer.php` pour supprimer une mesure via son `id` et rediriger vers `index.php`.
- [ ] **Git Push #2 :** `git add . && git commit -m "feat: CRUD complet PHP PDO" && git push`

---

## 🛡️ Sprint 3 : Défi Sécurité « Hack & Fix » (20 min)

### Exercice 8 — Blindage de l'application
- [ ] **Test XSS :** Insérer un patient nommé `<script>alert('Piraté !')</script>` dans phpMyAdmin et recharger `index.php`.
- [ ] **Fix XSS :** Protéger tous les affichages dans `index.php` avec `htmlspecialchars()`.
- [ ] **Fix SQLi :** Vérifier que `ajouter.php` et `supprimer.php` utilisent uniquement des requêtes préparées (`prepare` / `execute`).
- [ ] **Validation serveur :** Bloquer dans `ajouter.php` toute valeur hors bornes (`20 <= poids <= 300`, `0.5 <= taille <= 2.5`).
- [ ] **Livraison finale :** Mettre à jour `imc_db.sql` à la racine du projet et faire le dernier `git push`.
