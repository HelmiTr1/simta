<?php 
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});
Breadcrumbs::for('cont', function ($trail) {
    $trail->parent('home');
    $trail->push('Content', route('content.index'));
});
Breadcrumbs::for('menu', function ($trail) {
    $trail->parent('home');
    $trail->push('Menu', route('menu.index'));
});
Breadcrumbs::for('user', function ($trail) {
    $trail->parent('home');
    $trail->push('User', route('user.index'));
});
Breadcrumbs::for('berkas', function ($trail) {
    $trail->parent('home');
    $trail->push('Berkas', route('berkas'));
});
Breadcrumbs::for('sidang', function ($trail) {
    $trail->parent('home');
    $trail->push('Sidang', route('sidang'));
});
Breadcrumbs::for('jadwal', function ($trail) {
    $trail->parent('sidang');
    $trail->push('Jadwal', route('jadwal.index'));
});
Breadcrumbs::for('hari', function ($trail) {
    $trail->parent('sidang');
    $trail->push('Hari', route('hari.index'));
});
Breadcrumbs::for('ruangan', function ($trail) {
    $trail->parent('sidang');
    $trail->push('Ruangan', route('ruangan.index'));
});
Breadcrumbs::for('tambahr', function ($trail) {
    $trail->parent('ruangan');
    $trail->push('Tambah', route('ruangan.create'));
});
Breadcrumbs::for('revisi', function ($trail) {
    $trail->parent('berkas');
    $trail->push('Revisi', route('revisi.index'));
});
Breadcrumbs::for('nilai', function ($trail) {
    $trail->parent('sidang');
    $trail->push('Nilai Sidang', route('nilai.index'));
});

Breadcrumbs::for('isi', function ($trail,$category) {
    $trail->parent('nilai');
    $trail->push($category, route('nilai.edit',$category));
});
?>