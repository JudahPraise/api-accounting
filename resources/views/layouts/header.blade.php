<!--begin::Header-->
<div id="kt_app_header" class="app-header " data-kt-sticky="true" data-kt-sticky-activate="{default: false, lg: true}"
	data-kt-sticky-name="app-header-sticky" data-kt-sticky-offset="{default: false, lg: '300px'}">
	<div class="app-container  container-fluid d-flex flex-stack " id="kt_app_header_container">
		<div class="d-flex align-items-center d-block d-lg-none ms-n3" title="Show sidebar menu">
			<div class="btn btn-icon btn-active-color-primary w-35px h-35px me-2" id="kt_app_sidebar_mobile_toggle">
				<span class="svg-icon svg-icon-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
						xmlns="../../../www.w3.org/2000/svg.html">
						<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
							fill="currentColor" />
						<path opacity="0.3"
							d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
							fill="currentColor" />
					</svg>
				</span>
			</div>

			<a href="index.html">
				<img alt="Logo" src="{{ asset('images/cashier-logo.png') }}" class="h-30px theme-light-show" />
				<img alt="Logo" src="{{ asset('images/cashier-logo.png') }}" class="h-30px theme-dark-show" />
			</a>
		</div>
		<div class="d-flex flex-stack flex-lg-row-fluid" id="kt_app_header_wrapper">

			<div class="page-title gap-4 me-3 mb-5 mb-lg-0" data-kt-swapper="true"
				data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
				data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_header_wrapper'}">

				<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 mb-2" id="main_breadcrumbs">

				</ul>
				<h1 class="text-gray-900 fw-bolder m-0" id="header_name">
					
				</h1>
			</div>
			
			<div id="header_action_wrapper">
				
			</div>
		</div>
	</div>
</div>