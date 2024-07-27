# EHRS2
 Hello! I developed an Electronic Health Records System using Laravel and Vue frameworks for my college thesis/capstone project. This system is designed to meet the data management needs of Visayas State University Hospital. The system includes features such as:

- In and Out patient management
- Medical records storage and retrieval
- Secure access control for medical staff
- Reporting and analytics for hospital administration

 #Installation Manual
**Install Composer**
Run composer install in a CMD prompt.
**Install Node**
Run npm install in a CMD prompt.
**Create a copy of your .env file**
cp .env.example .env
**Generate App Key**
php artisan key:generate
php artisan migrate
php artisan db:seed
**Run Locally**
php artisan serve
npm run dev