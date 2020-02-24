@extends('frontend.layouts.app')

@section('pageTitle', 'Downloads')

@section('content')
<div class="container">

    <h1 class="page-heading page-heading">Downloads</h1>

    <div class="row justify-content-center align-items-end content">

        <div class="col-lg">
            <div class="card mb-4" >
                <div class="card-header">
                    <h2>Backend</h2>
                </div>
                <div class="card-body">
                    <p class="lead">CMS zur Erstellung und Verwaltung von Geräten, Benutzern und Inhalten für Digital Signage</p>
                    <p>Github-Repository<br><a class="btn btn-outline-secondary" href="https://github.com/Sixl-Daniel/FST-Projekt-VSPOT" target="_blank"><i class="fab fa-fw fa-github"></i> github.com/Sixl-Daniel/FST-Projekt-VSPOT</a></p>
                </div>
            </div>
            <div class="card mb-4" >
                <div class="card-header">
                    <h2>Client, Mobile<br><small>Android</small></h2>
                </div>
                <div class="card-body">
                    <p>Github-Repository<br><a class="btn btn-outline-secondary" href="https://github.com/StefanSuess/VSPOT-AndroidApp" target="_blank"><i class="fab fa-fw fa-github"></i> github.com/StefanSuess/VSPOT-AndroidApp</a></p>
                </div>
            </div>
            <div class="card mb-4" >
                <div class="card-header">
                    <h2>Helfer<br><small>Android</small></h2>
                </div>
                <div class="card-body">
                    <p class="lead">App zum Scannen nach Client-Geräten im Netzwerk</p>
                    <p>Github-Repository<br><a class="btn btn-outline-secondary" href="https://github.com/StefanSuess/Vspot-Companion" target="_blank"><i class="fab fa-fw fa-github"></i>  github.com/StefanSuess/Vspot-Companion</a></p>
                </div>
            </div>
        </div>

        <div class="col-lg">
            <div class="card mb-4" >
                <div class="card-header">
                    <h2>Client, Desktop<br><small>Windows, Linux</small></h2>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <h3>Repositories</h3>
                        <p>Github-Repository / Code<br><a class="btn btn-outline-secondary" href="https://github.com/Sixl-Daniel/VSPOT-Hybrid-Application" target="_blank"><i class="fab fa-fw fa-github"></i> github.com/Sixl-Daniel/VSPOT-Hybrid-Application</a></p>
                        <p>Github-Repository / Distribution<br><a class="btn btn-outline-secondary" href="https://github.com/Sixl-Daniel/VSPOT-Hybrid-Application-Dist" target="_blank"><i class="fab fa-fw fa-github"></i> github.com/Sixl-Daniel/VSPOT-Hybrid-Application-Dist</a></p>
                    </li>
                    <li class="list-group-item">
                        <h3>Installer</h3>
                        <p><a class="btn btn-lg btn-outline-secondary" href="{{ Storage::url('apps/VSPOT-Client-App-1.0.0-Setup-Windows.zip')  }}"><i class="fab fa-fw fa-windows"></i> Windows Installer <small>[.exe]</small></a></p>
                        <p><a class="btn btn-lg btn-outline-secondary" href="{{ Storage::url('apps/vspot-app_1.0.0_amd64.zip')  }}"><i class="fab fa-fw fa-linux"></i> Linux Installer (AMD64)  <small>[.deb]</small></a></p>
                        <p><a class="btn btn-lg btn-outline-secondary" href="{{ Storage::url('apps/vspot-app_1.0.0_armhf.zip')  }}"><i class="fab fa-fw fa-raspberry-pi"></i> Linux Installer (ARMhf)  <small>[.deb]</small></a></p>
                    </li>
                    <li class="list-group-item">
                        <h3>Images</h3>
                        <p><a class="btn btn-lg btn-dark" href="{{ Storage::url('apps/image-230220-clean.zip')  }}"><i class="fas fa-compact-disc"></i><i class="fab fa-fw fa-raspberry-pi"></i> Raspbian-Image mit App (zip, 1.3GB)  <small>[.iso]</small></a></p>
                        <p><a class="btn btn-lg btn-dark" href="{{ Storage::url('apps/image-230220-clean.7z')  }}"><i class="fas fa-compact-disc"></i><i class="fab fa-fw fa-raspberry-pi"></i> Raspbian-Image mit App (7z, 936MB) <small>[.iso]</small></a></p>
                    </li>
                </ul>
            </div>
        </div>

</div>
@endsection
