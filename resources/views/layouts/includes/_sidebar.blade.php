<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="/dashboard" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						@if(auth()->user()->role == 'siswa')
						<li><a href="/user/{{auth()->user()->id}}/profile" class=""><i class="lnr lnr-user"></i> <span>Profileku</span></a></li>
						@elseif(auth()->user()->role == 'admin')
						<li><a href="/siswa" class=""><i class="lnr lnr-user"></i> <span>Siswa</span></a></li>
						@endif
					</ul>
				</nav>
			</div>
		</div>