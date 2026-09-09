@echo off
set PATH=C:\Program Files\nodejs;%PATH%
cd /d "C:\Users\Ramir\Herd\student-app"
echo Running npm install...
call npm install --no-fund --no-audit
echo Running npm run build...
call npm run build
echo Build completed!
