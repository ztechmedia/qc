<li class="xn-openable performance">
	<a><span class="fa fa-bar-chart-o"></span> <span class="xn-text">Produktifitas</span></a>
	<ul>
		<li class="p-slitting"><a class="side-submenu" data-url="<?= base_url("admin/performance/slitting/$currentYear/$currentMonth") ?>" data-menu=".performance" data-submenu=".p-slitting"><span class="fa fa-crosshairs"></span> Slitting</a></li>
		<li class="p-cpp"><a class="side-submenu" data-url="<?= base_url("admin/performance/cpp/$currentYear/$currentMonth") ?>" data-menu=".performance" data-submenu=".p-cpp"><span class="fa fa-crosshairs"></span> CPP</a></li>
		<li class="p-metalize"><a class="side-submenu" data-url="<?= base_url("admin/performance/metalize/$currentYear/$currentMonth") ?>" data-menu=".performance" data-submenu=".p-metalize"><span class="fa fa-crosshairs"></span> Metalize</a></li>
	</ul>
</li>

<?php if ($this->auth->role_id == 1) { ?>
	<li class="xn-openable users">
		<a><span class="fa fa-user"></span> <span class="xn-text">Akun QA</span></a>
		<ul>
			<li class="admin"><a class="side-submenu" data-url="<?= base_url("admin/users/1") ?>" data-menu=".users" data-submenu=".admin"><span class="fa fa-crosshairs"></span> Admin</a></li>

			<li class="mgr"><a class="side-submenu" data-url="<?= base_url("admin/users/2") ?>" data-menu=".users" data-submenu=".mgr"><span class="fa fa-crosshairs"></span> Manager</a></li>

			<li class="spv"><a class="side-submenu" data-url="<?= base_url("admin/users/3") ?>" data-menu=".users" data-submenu=".spv"><span class="fa fa-crosshairs"></span>
					Supervisor</a></li>

			<li class="lab"><a class="side-submenu" data-url="<?= base_url("admin/users/4") ?>" data-menu=".users" data-submenu=".lab"><span class="fa fa-crosshairs"></span> Lab & Inspection</a></li>

			<li class="inout"><a class="side-submenu" data-url="<?= base_url("admin/users/5") ?>" data-menu=".users" data-submenu=".inout"><span class="fa fa-crosshairs"></span> In & Out</a></li>
		</ul>
	</li>

	<li class="xn-openable prod-users">
		<a><span class="fa fa-user"></span> <span class="xn-text">Akun Produksi</span></a>
		<ul>
			<li class="packing-user"><a class="side-submenu" data-url="<?= base_url("admin/users/6") ?>" data-menu=".prod-users" data-submenu=".packing-user"><span class="fa fa-crosshairs"></span> Packing</a></li>
		</ul>
	</li>
<?php } ?>

<?php if ($this->auth->role_id != 6) { ?>
	<li class="xn-openable master">
		<a><span class="fa fa-hdd-o"></span> <span class="xn-text">Master</span></a>
		<ul>
			<li class="customer-alias"><a class="side-submenu" data-url="<?= base_url("admin/master/customer-alias") ?>" data-menu=".master" data-submenu=".customer-alias"><span class="fa fa-crosshairs"></span> Customer Alias</a></li>
			<?php if ($this->auth->role_id == 1) { ?>
				<li class="defect-alias"><a class="side-submenu" data-url="<?= base_url("admin/master/defect-alias") ?>" data-menu=".master" data-submenu=".defect-alias"><span class="fa fa-crosshairs"></span> Defect Alias</a></li>
			<?php } ?>
		</ul>
	</li>

	<li class="xn-openable productions">
		<a><span class="fa fa-cogs"></span> <span class="xn-text">Produksi</span></a>
		<ul>
			<li class="cpp"><a class="side-submenu" data-url="<?= base_url("admin/productions/cpp/main/$currentYear/$currentMonth/$currentDay") ?>" data-menu=".productions" data-submenu=".cpp"><span class="fa fa-crosshairs"></span>
					CPP</a></li>
			<li class="metalize"><a class="side-submenu" data-url="<?= base_url("admin/productions/metalize/main/$currentYear/$currentMonth/$currentDay") ?>" data-menu=".productions" data-submenu=".metalize"><span class="fa fa-crosshairs"></span>
					Metalize</a></li>
			<li class="slitting"><a class="side-submenu" data-url="<?= base_url("admin/productions/slitting/main/$currentYear/$currentMonth/$currentDay") ?>" data-menu=".productions" data-submenu=".slitting"><span class="fa fa-crosshairs"></span>
					Slitting</a></li>
			<li class="ncr"><a class="side-submenu" data-url="<?= base_url("admin/productions/ncr/$currentDate/A") ?>" data-menu=".productions" data-submenu=".ncr"><span class="fa fa-crosshairs"></span>
					List NCR</a></li>
			<li class="released"><a class="side-submenu" data-url="<?= base_url("admin/productions/released/$currentYear/$currentMonth") ?>" data-menu=".productions" data-submenu=".released"><span class="fa fa-crosshairs"></span>
					Release Roll</a></li>
		</ul>
	</li>
<?php } ?>

<?php if ($this->auth->role_id == 6 || $this->auth->role_id == 1) { ?>
	<li class="xn-openable packing">
		<a><span class="fa fa-gift"></span> <span class="xn-text">Packing</span></a>
		<ul>
			<li class="palet"><a class="side-submenu" data-url="<?= base_url("admin/productions/packing/palet") ?>" data-menu=".packing" data-submenu=".palet"><span class="fa fa-crosshairs"></span>
					Palet</a></li>
		</ul>
	</li>
<?php } ?>

<li class="developer">
	<a class="side-menu" data-url="<?= base_url("admin/developer") ?>" data-menu=".developer"><span class="fa fa-code"></span> <span class="xn-text">Developer</span></a>
</li>