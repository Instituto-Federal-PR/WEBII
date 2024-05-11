<!DOCTYPE html> 
	<html lang="en"> 
	<head> 
		<meta charset="UTF-8"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Sistema de Gerenciamento de Atividades Complementares - SIGAC</title> 
		<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"/>
		<link rel="stylesheet" href="{{asset('css/all.min.css')}}"/> 
		<link rel="stylesheet" href="{{asset('css/style.css')}}"/> 
	</head> 
	<body> 
		<nav class="navbar navbar-expand-lg bg-body-tertiary">
			<div class="container-fluid">
				<a class="navbar-brand" href="{{route('site')}}">
					<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#5CB85C" class="bi bi-folder-symlink-fill" viewBox="0 0 16 16">
						<path d="M13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2l.04.87a2 2 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3M2.19 3q-.362.002-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672a1 1 0 0 1 .707.293L7.586 3zm9.608 5.271-3.182 1.97c-.27.166-.616-.036-.616-.372V9.1s-2.571-.3-4 2.4c.571-4.8 3.143-4.8 4-4.8v-.769c0-.336.346-.538.616-.371l3.182 1.969c.27.166.27.576 0 .742"/>
					</svg>
					<span class="ms-2 fs-2 fw-bold text-success">SIGAC</span> 
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				
				<div class="collapse navbar-collapse ms-4" id="navbarNavDropdown">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link" aria-current="page" href="{{route('home')}}">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#5CB85C" class="bi bi-lock-fill" viewBox="0 0 16 16">
									<path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2"/>
								</svg>
								<span class="ms-1 fs-5 text-success align-middle">Autenticação</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" aria-current="page" href="{{route('site.register')}}">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#5CB85C" class="bi bi-pencil-square" viewBox="0 0 16 16">
									<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
									<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
								  </svg>
								<span class="ms-1 fs-5 text-success align-middle">Registro</span>
							</a>
						</li>
					</ul>
			  </div>
			</div>
		</nav>
		<hr class="m-2">
		<div class="container py-4">
			@yield('conteudo')
		</div>
	</body>
	<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>  
	<script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>  

	@yield('script')
</html>
