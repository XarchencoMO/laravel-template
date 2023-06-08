@servers(['prod' => '<your_user_name>@<prod_server_ip> -p <port>', 'dev' => '<your_user_name>>@<dev_server_port> -p <port>'])

@setup
    $repository = "ssh://git@git2.niioz.ru:22019/nii_projects/<your_project_name>.git";
    $app_dir = '/var/www/<your_project_name>';
    $releases_dir = '/var/www/<your_project_name>/releases';
    $release = date('YmdHis');
    $new_release_dir = $releases_dir .'/'. $release;
    $releaseRotate = 5
@endsetup

@story('deploy', ['on' => ['prod'] ])
    clone_repository
    run_composer
    run_npm
    run_optimization
    update_symlinks
@endstory

@story('deploy_dev', ['on' => ['dev'] ])
    clone_repository
    run_composer
    run_npm
    run_optimization
    update_symlinks
@endstory

@task('clone_repository')
    echo 'Cloning repository'
    [ -d {{ $releases_dir }} ] || mkdir {{ $releases_dir }}
    git clone --depth 1 {{ $repository }} {{ $new_release_dir }}
    cd {{ $new_release_dir }}
    git reset --hard {{ $commit }}
@endtask

@task('run_composer')
    echo "Starting deployment ({{ $release }})"
    cd {{ $new_release_dir }}
    echo "installing composer dependencies"
    composer install --prefer-dist --no-scripts -q -o
@endtask

@task('run_optimization')
    echo "Starting optimization ({{ $release }})"
    cd {{ $new_release_dir }}
    php artisan optimize:clear
    php artisan optimize
@endtask

@task('run_npm')
    echo "Installing npm dependencies"
    cd {{ $new_release_dir }}
    npm install
    echo "building vite"
    npm run build
@endtask

@task('update_symlinks')
    echo "Linking storage directory"
    rm -rf {{ $new_release_dir }}/storage
    ln -nfs {{ $app_dir }}/storage {{ $new_release_dir }}/storage

    echo 'Linking .env file'
    ln -nfs {{ $app_dir }}/.env {{ $new_release_dir }}/.env

    echo 'Linking current release'
    ln -nfs {{ $new_release_dir }} {{ $app_dir }}/current
@endtask

@task('releases_clean')
    purging=$(ls -dt {{$dirReleases}}/* | tail -n +{{$releaseRotate}});

    if [ "$purging" != "" ]; then
    echo "# Purging old releases: $purging;"
    rm -rf $purging;
    else
    echo "# No releases found for purging at this time";
    fi
@endtask

@task('run_migrations')
    echo "Starting to migrate database ({{ $release }})"
    cd {{ $new_release_dir }}
    php artisan migrate --force
@endtask
