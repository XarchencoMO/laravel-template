## Пустой docker compose шаблон для проектов nii  

### Инструкция по использованию:  

1. Скачайте репозиторий
2. Скопируйте содержимое репозитория в свой проект

    (папку docker и файл docker-compose.yaml)
3. Решите все `TODO` в папке docker
4. Добавьте в `.env` файл переменную `PROJECT_NAME`

    Пример : `PROJECT_NAME=test_project`
5. Запустите команду `docker compose up -d --build`
6. Ожидайте сборки контейнеров
