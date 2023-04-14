@echo off
start cmd /c php artisan serve
start cmd /c npm run dev
start chrome "http://127.0.0.1:8000"
