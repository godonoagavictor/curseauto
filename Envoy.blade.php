{{-- Generate first a ssh key on your local machine, using this command
# ssh-keygen
save it in your user folder to the following path:
# %USERPROFILE%/.ssh
then copy the content of id_rsa.pub to the end of the file
/home/dev/.ssh/authorized_keys on staging server --}}
@servers(['staging' => 'dev@host4.rts.md'])

@setup
    $repository = 'git@git2.rts.local:rts-dev/rts-cms.git';
    $releases_dir = '/home/dev/public_html/rts-cms/releases';
    $app_dir = '/home/dev/public_html/rts-cms';
    $release = date('YmdHis');
    $new_release_dir = $releases_dir .'/'. $release;
@endsetup

@story('deploy')
    clone_repository
    run_composer
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
    composer install --prefer-dist --no-scripts -q -o
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
