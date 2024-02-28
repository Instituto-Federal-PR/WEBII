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
		<div class="container-fluid p-0 d-flex h-100"> 
			<div class="d-flex flex-column flex-shrink-0 p-3 bg-success text-white offcanvas-md offcanvas-start" id="sidebar"> 
				<a href="#" class="navbar-brand" id="itens">
					<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#FFF" class="bi bi-folder-symlink-fill" viewBox="0 0 16 16">
						<path d="M13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2l.04.87a2 2 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3M2.19 3q-.362.002-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672a1 1 0 0 1 .707.293L7.586 3zm9.608 5.271-3.182 1.97c-.27.166-.616-.036-.616-.372V9.1s-2.571-.3-4 2.4c.571-4.8 3.143-4.8 4-4.8v-.769c0-.336.346-.538.616-.371l3.182 1.969c.27.166.27.576 0 .742"/>
					</svg>
					<span class="ms-2 fs-4 fw-bold">SIGAC</span> 
				</a>
				<hr> 
				<ul class="mynav nav nav-pills flex-column mb-auto"> 
					<!-- MENU ADMINISTRADOR -->
					<li class="sidebar-item nav-item mb-1"> 
						<a href="#"	class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#admin" aria-expanded="false" aria-controls="admin"> 
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-person-vcard-fill" viewBox="0 0 16 16">
								<path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm9 1.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4a.5.5 0 0 0-.5.5M9 8a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4A.5.5 0 0 0 9 8m1 2.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5m-1 2C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 0 2 13h6.96q.04-.245.04-.5M7 6a2 2 0 1 0-4 0 2 2 0 0 0 4 0"/>
							</svg>
							<span class="ms-2">Administrador</span>
						</a> 
						<ul id="admin" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"> 					
							<li class="sidebar-item"> 
								<a href="" class="sidebar-link"> 
									<span class="ms-3">Coordenadores</span> 
								</a> 
							</li> 
							<li class="sidebar-item"> 
								<a href="{{route('curso.index')}}" class="sidebar-link"> 
									<span class="ms-3">Cursos</span> 
								</a> 
							</li> 
							<li class="sidebar-item"> 
								<a href="{{route('curso.index')}}" class="sidebar-link"> 
									<span class="ms-3">Eixos</span> 
								</a> 
							</li>
							<li class="sidebar-item"> 
								<a href="{{route('nivel.index')}}" class="sidebar-link"> 
									<span class="ms-3">Níveis de Ensino</span> 
								</a> 
							</li>  
						</ul> 
					</li>
					<!-- MENU COORDENADOR -->
					<li class="sidebar-item nav-item mb-1"> 
						<a href="#"	class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#coord" aria-expanded="false" aria-controls="coord"> 
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-person-workspace" viewBox="0 0 16 16">
								<path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
								<path d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.4 5.4 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2z"/>
							</svg>
							<span class="ms-2">Coordenador</span>
						</a> 
						<ul id="coord" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"> 					
							<li class="sidebar-item"> 
								<a href="#" class="sidebar-link"> 
									<span class="ms-3">Alunos</span> 
								</a> 
							</li> 
							<li class="sidebar-item"> 
								<a href="#" class="sidebar-link"> 
									<span class="ms-3">Avaliar Horas</span> 
								</a> 
							</li> 
							<li class="sidebar-item"> 
								<a href="#" class="sidebar-link"> 
									<span class="ms-3">Categorias</span> 
								</a> 
							</li> 
							<li class="sidebar-item"> 
								<a href="#" class="sidebar-link"> 
									<span class="ms-3">Gráfico Alunos</span> 
								</a> 
							</li>
							<li class="sidebar-item"> 
								<a href="#" class="sidebar-link"> 
									<span class="ms-3">Gráfico Horas</span> 
								</a> 
							</li>
							<li class="sidebar-item"> 
								<a href="#" class="sidebar-link"> 
									<span class="ms-3">Professores</span> 
								</a> 
							</li>
							<li class="sidebar-item"> 
								<a href="#" class="sidebar-link"> 
									<span class="ms-3">Relatório Horas</span> 
								</a> 
							</li> 
							<li class="sidebar-item"> 
								<a href="#" class="sidebar-link"> 
									<span class="ms-3">Turmas</span> 
								</a> 
							</li> 
							<li class="sidebar-item"> 
								<a href="#" class="sidebar-link"> 
									<span class="ms-3">Validar Cadastro</span> 
								</a> 
							</li>  
						</ul> 
					</li>
					<!-- MENU PROFESSOR -->
					<li class="sidebar-item nav-item mb-1"> 
						<a href="#"	class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#prof" aria-expanded="false" aria-controls="prof"> 
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
								<path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z"/>
							</svg>
							<span class="ms-2">Professor</span>
						</a> 
						<ul id="prof" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"> 					
							<li class="sidebar-item"> 
								<a href="#" class="sidebar-link"> 
									<span class="ms-3">Cadastrar Horas</span> 
								</a> 
							</li> 
						</ul> 
					</li>
					<!-- MENU ALUNO -->
					<li class="sidebar-item nav-item mb-1"> 
						<a href="#"	class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#aluno" aria-expanded="false" aria-controls="aluno"> 
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-people-fill" viewBox="0 0 16 16">
								<path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
							</svg>
							<span class="ms-2">Aluno</span>
						</a> 
						<ul id="aluno" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"> 					
							<li class="sidebar-item"> 
								<a href="#" class="sidebar-link"> 
									<span class="ms-3">Solicitar Horas</span> 
								</a> 
							</li> 
							<li class="sidebar-item"> 
								<a href="#" class="sidebar-link"> 
									<span class="ms-3">Gerar Declaração</span> 
								</a> 
							</li> 
						</ul> 
					</li>
					<hr>
					<li class="sidebar-item nav-item mb-1"> 
						<a href="#"	class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#user" aria-expanded="false" aria-controls="user"> 
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-person-circle" viewBox="0 0 16 16">
								<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
								<path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
							  </svg>
							<span class="ms-2">Usuário</span>
						</a> 
						<ul id="user" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"> 					
							<li class="sidebar-item"> 
								<a href="#" class="sidebar-link"> 
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#FFF" class="bi bi-door-open-fill ms-3" viewBox="0 0 16 16">
										<path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15zM11 2h.5a.5.5 0 0 1 .5.5V15h-1zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1"/>
									</svg>
									<span class="ms-1">Sair</span> 
								</a> 
							</li> 
						</ul> 
					</li> 
				</ul> 
				<hr> 
				<div class="d-flex align-content-center justify-content-center"> 
					<img src="{{asset('img/ifpr.png')}}" width="128px" height="128px">
				</div> 
			</div> 
			<div class="bg-light flex-fill"> 
				<div class="p-2 d-md-none d-flex text-white bg-success"> 
					<a href="#" class="text-white" data-bs-toggle="offcanvas" data-bs-target="#sidebar"> 
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-list" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
						</svg>
					</a> 
					<span class="ms-3">Gerenciamento Atividades Complementares</span> 
				</div> 
				<div class="p-4"> 
					<nav style="--bs-breadcrumb-divider:'>'; font-size:14px"> 
						<!-- TÍTULO -->
						<span class="fs-2 text-success"> {{ $titulo }} </span> 
					</nav> 
					<hr> 
					<!-- CONTEÚDO -->
					<div class="row"> 
						<div class="col"> 
                            @yield('conteudo')
						</div> 
					</div> 
				</div> 
			</div> 
		</div> 
	</body> 

	<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>  
	<script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>  
	
	@yield('script')

</html>
