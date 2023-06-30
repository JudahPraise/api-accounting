<!--begin::Sidebar-->
<div id="app_sidebar" class="app-sidebar  flex-column " data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
	data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px"
	data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">

	<!--begin::Header-->
	<div class="app-sidebar-header d-none d-lg-flex px-6 pt-8 pb-4" id="kt_app_sidebar_header">
		<!--begin::Toggle-->
		<button type="button" data-kt-element="selected" class="btn btn-outline btn-custom btn-flex w-100"
			data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="0px, -1px">
			<!--begin::Logo-->
			<span class="d-flex flex-center flex-shrink-0 w-40px me-7">
				<img alt="Logo" src="{{ asset('images/cashier-logo.png') }}" data-kt-element="logo" class="h-30px" />
			</span>
			<!--end::Logo-->

			<!--begin::Info-->
			<span class="d-flex flex-column align-items-start flex-grow-1">
				<span class="fs-5 fw-bold text-white text-uppercase" data-kt-element="title">
					Cashier </span>
				<span class="fs-7 fw-bold text-gray-700 lh-sm" data-kt-element="desc">
					Workspace </span>
			</span>
			<!--end::Info-->

			<!--begin::Arrows-->
			<span class="d-flex flex-column me-n4">
				<!--begin::Svg Icon | path: icons/duotune/arrows/arr073.svg-->
				<span class="svg-icon svg-icon-3 svg-icon-gray-700"><svg width="24" height="24" viewBox="0 0 24 24"
						fill="none" xmlns="../../../www.w3.org/2000/svg.html">
						<path
							d="M12.5657 11.3657L16.75 15.55C17.1642 15.9643 17.8358 15.9643 18.25 15.55C18.6642 15.1358 18.6642 14.4643 18.25 14.05L12.7071 8.50716C12.3166 8.11663 11.6834 8.11663 11.2929 8.50715L5.75 14.05C5.33579 14.4643 5.33579 15.1358 5.75 15.55C6.16421 15.9643 6.83579 15.9643 7.25 15.55L11.4343 11.3657C11.7467 11.0533 12.2533 11.0533 12.5657 11.3657Z"
							fill="currentColor" />
					</svg>
				</span>
				<!--end::Svg Icon-->
				<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
				<span class="svg-icon svg-icon-3 svg-icon-gray-700"><svg width="24" height="24" viewBox="0 0 24 24"
						fill="none" xmlns="../../../www.w3.org/2000/svg.html">
						<path
							d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
							fill="currentColor" />
					</svg>
				</span>
				<!--end::Svg Icon-->
			</span>
			<!--end::Arrows-->
		</button>
		<!--end::Toggle-->

		<!--begin::Menu-->
		{{-- <div class="menu menu-sub menu-sub-dropdown menu-column menu-state-bg menu-rounded w-300px ps-3"
			data-kt-menu="true">
			<!--begin::Menu wrapper-->
			<div class="hover-scroll-y h-250px my-3 pe-5 me-n1">
				<!--begin::Menu item-->
				<div class="menu-item">
					<!--begin::Menu link-->
					<a href="#" class="menu-link px-3 py-3 active" data-kt-element="project">
						<!--begin::Logo-->
						<span class="d-flex flex-center flex-shrink-0 w-40px me-3">
							<img alt="Logo" src="assets/media/logos/default-small.svg" data-kt-element="logo"
								class="h-30px" />
						</span>
						<!--end::Logo-->

						<!--begin::Info-->
						<span class="d-flex flex-column align-items-start">
							<span class="fs-5 fw-bold text-white text-uppercase" data-kt-element="title">
								Metronic </span>
							<span class="fs-7 fw-bold text-gray-700 lh-sm" data-kt-element="desc">
								Workspace </span>
						</span>
						<!--end::Info-->
					</a>
				</div>
				<!--end::Menu item-->
				<!--begin::Menu item-->
				<div class="menu-item">
					<!--begin::Menu link-->
					<a href="#" class="menu-link px-3 py-3 " data-kt-element="project">
						<!--begin::Logo-->
						<span class="d-flex flex-center flex-shrink-0 w-40px me-3">
							<img alt="Logo" src="assets/media/svg/brand-logos/slack-icon.svg" data-kt-element="logo"
								class="h-30px" />
						</span>
						<!--end::Logo-->

						<!--begin::Info-->
						<span class="d-flex flex-column align-items-start">
							<span class="fs-5 fw-bold text-white text-uppercase" data-kt-element="title">
								Slack </span>
							<span class="fs-7 fw-bold text-gray-700 lh-sm" data-kt-element="desc">
								Messanger </span>
						</span>
						<!--end::Info-->
					</a>
				</div>
				<!--end::Menu item-->
				<!--begin::Menu item-->
				<div class="menu-item">
					<!--begin::Menu link-->
					<a href="#" class="menu-link px-3 py-3 " data-kt-element="project">
						<!--begin::Logo-->
						<span class="d-flex flex-center flex-shrink-0 w-40px me-3">
							<img alt="Logo" src="assets/media/svg/brand-logos/dribbble-icon-1.svg"
								data-kt-element="logo" class="h-30px" />
						</span>
						<!--end::Logo-->

						<!--begin::Info-->
						<span class="d-flex flex-column align-items-start">
							<span class="fs-5 fw-bold text-white text-uppercase" data-kt-element="title">
								Dribbble </span>
							<span class="fs-7 fw-bold text-gray-700 lh-sm" data-kt-element="desc">
								Community </span>
						</span>
						<!--end::Info-->
					</a>
				</div>
				<!--end::Menu item-->
				<!--begin::Menu item-->
				<div class="menu-item">
					<!--begin::Menu link-->
					<a href="#" class="menu-link px-3 py-3 " data-kt-element="project">
						<!--begin::Logo-->
						<span class="d-flex flex-center flex-shrink-0 w-40px me-3">
							<img alt="Logo" src="assets/media/svg/brand-logos/bootstrap5.svg" data-kt-element="logo"
								class="h-30px" />
						</span>
						<!--end::Logo-->

						<!--begin::Info-->
						<span class="d-flex flex-column align-items-start">
							<span class="fs-5 fw-bold text-white text-uppercase" data-kt-element="title">
								Bootstrap </span>
							<span class="fs-7 fw-bold text-gray-700 lh-sm" data-kt-element="desc">
								CSS & JS Framework </span>
						</span>
						<!--end::Info-->
					</a>
				</div>
				<!--end::Menu item-->
				<!--begin::Menu item-->
				<div class="menu-item">
					<!--begin::Menu link-->
					<a href="#" class="menu-link px-3 py-3 " data-kt-element="project">
						<!--begin::Logo-->
						<span class="d-flex flex-center flex-shrink-0 w-40px me-3">
							<img alt="Logo" src="assets/media/svg/brand-logos/spotify-2.svg" data-kt-element="logo"
								class="h-30px" />
						</span>
						<!--end::Logo-->

						<!--begin::Info-->
						<span class="d-flex flex-column align-items-start">
							<span class="fs-5 fw-bold text-white text-uppercase" data-kt-element="title">
								Spotify </span>
							<span class="fs-7 fw-bold text-gray-700 lh-sm" data-kt-element="desc">
								Podcasts </span>
						</span>
						<!--end::Info-->
					</a>
				</div>
				<!--end::Menu item-->
				<!--begin::Menu item-->
				<div class="menu-item">
					<!--begin::Menu link-->
					<a href="#" class="menu-link px-3 py-3 " data-kt-element="project">
						<!--begin::Logo-->
						<span class="d-flex flex-center flex-shrink-0 w-40px me-3">
							<img alt="Logo" src="assets/media/svg/brand-logos/beats-electronics.svg"
								data-kt-element="logo" class="h-30px" />
						</span>
						<!--end::Logo-->

						<!--begin::Info-->
						<span class="d-flex flex-column align-items-start">
							<span class="fs-5 fw-bold text-white text-uppercase" data-kt-element="title">
								Beats </span>
							<span class="fs-7 fw-bold text-gray-700 lh-sm" data-kt-element="desc">
								Electronics </span>
						</span>
						<!--end::Info-->
					</a>
				</div>
				<!--end::Menu item-->
			</div>
			<!--end::Menu wrapper-->
		</div> --}}
		<!--end::Menu-->
	</div>
	<!--end::Header-->

	<!--begin::Navs-->
	<div class="app-sidebar-navs flex-column-fluid py-6" id="kt_app_sidebar_navs">
		<div id="kt_app_sidebar_navs_wrappers" class="hover-scroll-y my-2" data-kt-scroll="true"
			data-kt-scroll-activate="true" data-kt-scroll-height="auto"
			data-kt-scroll-dependencies="#kt_app_sidebar_header, #kt_app_sidebar_footer"
			data-kt-scroll-wrappers="#kt_app_sidebar_navs" data-kt-scroll-offset="5px">


			<!--begin::Quick links-->
			{{-- <div class="menu menu-rounded menu-column">
				<!--begin::Menu Item-->
				<div class="menu-item">
					<!--begin::Menu link-->
					<a href="apps/projects/project.html" class="menu-link">
						<!--begin::Icon-->
						<span class="menu-icon">
							<i class="fonticon-stats"></i>
						</span>
						<!--end::Icon-->

						<!--begin::Title-->
						<span class="menu-title">
							Notifications </span>
						<!--end::Title-->

						<!--begin::Badge-->
						<span class="menu-badge">
							<span class="badge badge-primary">
								6 </span>
						</span>
						<!--end::Badge-->
					</a>
					<!--end:::Menu link-->
				</div>
				<!--end::Menu Item-->

			</div> --}}
			<!--end::Quick links-->

			<!--begin::Separator-->
			{{-- <div class="app-sidebar-separator separator"></div> --}}
			<!--end::Separator-->
			<!--begin::Sidebar menu-->
			<div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false"
				class="menu menu-column menu-rounded menu-sub-indention menu-active-bg">
				<!--begin::Menu Item-->
				{{-- <div class="menu-item">
					<!--begin::Menu link-->
					<a id="dashboard" class="menu-link" data-page="dashboard">
						<!--begin::Icon-->
						<span class="menu-icon">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M3 2H10C10.6 2 11 2.4 11 3V10C11 10.6 10.6 11 10 11H3C2.4 11 2 10.6 2 10V3C2 2.4 2.4 2 3 2Z"
									fill="currentColor" />
								<path opacity="0.3"
									d="M14 2H21C21.6 2 22 2.4 22 3V10C22 10.6 21.6 11 21 11H14C13.4 11 13 10.6 13 10V3C13 2.4 13.4 2 14 2Z"
									fill="currentColor" />
								<path opacity="0.3"
									d="M3 13H10C10.6 13 11 13.4 11 14V21C11 21.6 10.6 22 10 22H3C2.4 22 2 21.6 2 21V14C2 13.4 2.4 13 3 13Z"
									fill="currentColor" />
								<path opacity="0.3"
									d="M14 13H21C21.6 13 22 13.4 22 14V21C22 21.6 21.6 22 21 22H14C13.4 22 13 21.6 13 21V14C13 13.4 13.4 13 14 13Z"
									fill="currentColor" />
							</svg>
						</span>
						<!--end::Icon-->
						<!--begin::Title-->
						<span class="menu-title">
							Dashboard 
						</span>
						<!--end::Title-->
					</a>
					<!--end:::Menu link-->
				</div> --}}
				<!--end::Menu Item-->
				<!--begin::Menu Item-->
				<div class="menu-item">
					<!--begin::Menu link-->
					<a id="fees" class="menu-link" data-page="fees">
						<!--begin::Icon-->
						<span class="menu-icon">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path opacity="0.3" d="M3 3V17H7V21H15V9H20V3H3Z" fill="currentColor" />
								<path
									d="M20 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H20C20.6 2 21 2.4 21 3V21C21 21.6 20.6 22 20 22ZM19 4H4V8H19V4ZM6 18H4V20H6V18ZM6 14H4V16H6V14ZM6 10H4V12H6V10ZM10 18H8V20H10V18ZM10 14H8V16H10V14ZM10 10H8V12H10V10ZM14 18H12V20H14V18ZM14 14H12V16H14V14ZM14 10H12V12H14V10ZM19 14H17V20H19V14ZM19 10H17V12H19V10Z"
									fill="currentColor" />
							</svg>
						</span>
						<!--end::Icon-->
						<!--begin::Title-->
						<span class="menu-title">
							Fees
						</span>
						<!--end::Title-->
					</a>
					<!--end:::Menu link-->
				</div>
				<!--end::Menu Item-->
				<!--begin::Menu Item-->
				<div class="menu-item">
					<!--begin::Menu link-->
					<a id="assessment" class="menu-link" data-page="assessment">
						<!--begin::Icon-->
						<span class="menu-icon">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path
									d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
									fill="currentColor" />
								<rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="currentColor" />
							</svg>
						</span>
						<!--end::Icon-->
						<!--begin::Title-->
						<span class="menu-title">
							Student Assessment
						</span>
						<!--end::Title-->
					</a>
					<!--end:::Menu link-->
				</div>
					<div class="menu-item">
						<a id="generate" class="menu-link" data-page="generate">
							<span class="menu-icon">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor" />
									<path
										d="M10.4 3.60001L12 6H21C21.6 6 22 6.4 22 7V19C22 19.6 21.6 20 21 20H3C2.4 20 2 19.6 2 19V4C2 3.4 2.4 3 3 3H9.20001C9.70001 3 10.2 3.20001 10.4 3.60001ZM12 16.8C11 16.8 10.2 16.4 9.5 15.8C8.8 15.1 8.5 14.3 8.5 13.3C8.5 12.8 8.59999 12.3 8.79999 11.9L10 13.1V10.1C10 9.50001 9.6 9.10001 9 9.10001H6L7.29999 10.4C6.79999 11.3 6.5 12.2 6.5 13.3C6.5 14.8 7.10001 16.2 8.10001 17.2C9.10001 18.2 10.5 18.8 12 18.8C12.6 18.8 13 18.3 13 17.8C13 17.2 12.6 16.8 12 16.8ZM16.7 16.2C17.2 15.3 17.5 14.4 17.5 13.3C17.5 11.8 16.9 10.4 15.9 9.39999C14.9 8.39999 13.5 7.79999 12 7.79999C11.4 7.79999 11 8.19999 11 8.79999C11 9.39999 11.4 9.79999 12 9.79999C12.9 9.79999 13.8 10.2 14.5 10.8C15.2 11.5 15.5 12.3 15.5 13.3C15.5 13.8 15.4 14.3 15.2 14.7L14 13.5V16.5C14 17.1 14.4 17.5 15 17.5H18L16.7 16.2Z"
										fill="currentColor" />
									<path opacity="0.3"
										d="M12 16.8C11 16.8 10.2 16.4 9.5 15.8C8.8 15.1 8.5 14.3 8.5 13.3C8.5 12.8 8.59999 12.3 8.79999 11.9L7.29999 10.4C6.79999 11.3 6.5 12.2 6.5 13.3C6.5 14.8 7.10001 16.2 8.10001 17.2C9.10001 18.2 10.5 18.8 12 18.8C12.6 18.8 13 18.3 13 17.8C13 17.2 12.6 16.8 12 16.8Z"
										fill="currentColor" />
									<path opacity="0.3"
										d="M15.5 13.3C15.5 13.8 15.4 14.3 15.2 14.7L16.7 16.2C17.2 15.3 17.5 14.4 17.5 13.3C17.5 11.8 16.9 10.4 15.9 9.39999C14.9 8.39999 13.5 7.79999 12 7.79999C11.4 7.79999 11 8.19999 11 8.79999C11 9.39999 11.4 9.79999 12 9.79999C12.9 9.79999 13.8 10.2 14.5 10.8C15.1 11.5 15.5 12.4 15.5 13.3Z"
										fill="currentColor" />
								</svg>
							</span>
							<span class="menu-title">
								Generate Assessment Form
							</span>
						</a>
					</div>
					<div class="menu-item">
						<a id="report" class="menu-link" data-page="report">
							<span class="menu-icon">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z"
										fill="currentColor" />
									<path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor" />
								</svg>
							</span>
							<span class="menu-title">
								Reports
							</span>
						</a>
					</div>
				
			</div>
				<div class="separator"></div>
				
				<div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false"
					class="menu menu-column menu-rounded menu-sub-indention menu-active-bg">
					<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
						<span class="menu-link">
							<span class="menu-icon">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path
										d="M16.0173 9H15.3945C14.2833 9 13.263 9.61425 12.7431 10.5963L12.154 11.7091C12.0645 11.8781 12.1072 12.0868 12.2559 12.2071L12.6402 12.5183C13.2631 13.0225 13.7556 13.6691 14.0764 14.4035L14.2321 14.7601C14.2957 14.9058 14.4396 15 14.5987 15H18.6747C19.7297 15 20.4057 13.8774 19.912 12.945L18.6686 10.5963C18.1487 9.61425 17.1285 9 16.0173 9Z"
										fill="currentColor" />
									<rect opacity="0.3" x="14" y="4" width="4" height="4" rx="2" fill="currentColor" />
									<path
										d="M4.65486 14.8559C5.40389 13.1224 7.11161 12 9 12C10.8884 12 12.5961 13.1224 13.3451 14.8559L14.793 18.2067C15.3636 19.5271 14.3955 21 12.9571 21H5.04292C3.60453 21 2.63644 19.5271 3.20698 18.2067L4.65486 14.8559Z"
										fill="currentColor" />
									<rect opacity="0.3" x="6" y="5" width="6" height="6" rx="3" fill="currentColor" />
								</svg>
							</span>
							<span class="menu-title">User Management</span>
							<span class="menu-arrow"></span>
						</span>
						<div class="menu-sub menu-sub-accordion">
							<div class="menu-item">
								<a class="menu-link" id="accounts">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Accounts</span>
								</a>
							</div>
							<div class="menu-item">
								<a class="menu-link" id="roles">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Roles</span>
								</a>
							</div>
							<div class="menu-item">
								<a class="menu-link" id="permissions">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Permissions</span>
								</a>
							</div>
						</div>
					</div>
					<div class="menu-item">
						<a id="admin-students-assessment" class="menu-link" data-page="automated-assessment">
							<span class="menu-icon">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path opacity="0.3"
										d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM14.5 12L12.7 9.3C12.3 8.9 11.7 8.9 11.3 9.3L10 12H11.5V17C11.5 17.6 11.4 18 12 18C12.6 18 12.5 17.6 12.5 17V12H14.5Z"
										fill="currentColor" />
									<path d="M13 11.5V17.9355C13 18.2742 12.6 19 12 19C11.4 19 11 18.2742 11 17.9355V11.5H13Z"
										fill="currentColor" />
									<path
										d="M8.2575 11.4411C7.82942 11.8015 8.08434 12.5 8.64398 12.5H15.356C15.9157 12.5 16.1706 11.8015 15.7425 11.4411L12.4375 8.65789C12.1875 8.44737 11.8125 8.44737 11.5625 8.65789L8.2575 11.4411Z"
										fill="currentColor" />
									<path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor" />
								</svg>
							</span>
							<span class="menu-title">
								Student Assessment
							</span>
						</a>
					</div>
				</div>
		</div>
	</div>


	<!--begin::Footer-->
	<div class="app-sidebar-footer d-flex flex-stack px-11 pb-10" id="kt_app_sidebar_footer">
		<!--begin::User menu-->
		<div class="">
			<!--begin::Menu wrapper-->
			<div class="cursor-pointer symbol symbol-circle symbol-40px"
				data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-overflow="true"
				data-kt-menu-placement="top-start">
				<img src="assets/media/avatars/300-2.jpg" alt="image" />
			</div>


			<!--begin::User account menu-->
			<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
				data-kt-menu="true">
				<!--begin::Menu item-->
				<div class="menu-item px-3">
					<div class="menu-content d-flex align-items-center px-3">
						<!--begin::Avatar-->
						<div class="symbol symbol-50px me-5">
							<img alt="Logo" src="assets/media/avatars/300-13.jpg" />
						</div>
						<!--end::Avatar-->

						

						<!--begin::Username-->
						<div class="d-flex flex-column">
							<div class="fw-bold d-flex align-items-center fs-5">
								{{ Auth::user()->username }}
							</div>

							<a href="#" class="fw-semibold text-muted text-hover-primary fs-7">
								{{ Auth::user()->email }} </a>
						</div>
						<!--end::Username-->
					</div>
				</div>
				<!--end::Menu item-->

				{{-- <!--begin::Menu separator-->
				<div class="separator my-2"></div>
				<!--end::Menu separator-->

				<!--begin::Menu item-->
				<div class="menu-item px-5">
					<a href="account/overview.html" class="menu-link px-5">
						My Profile
					</a>
				</div>
				<!--end::Menu item-->

				<!--begin::Menu item-->
				<div class="menu-item px-5">
					<a href="apps/projects/list.html" class="menu-link px-5">
						<span class="menu-text">My Projects</span>
						<span class="menu-badge">
							<span class="badge badge-light-danger badge-circle fw-bold fs-7">3</span>
						</span>
					</a>
				</div>
				<!--end::Menu item-->

				<!--begin::Menu item-->
				<div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
					data-kt-menu-placement="right-end" data-kt-menu-offset="-15px, 0">
					<a href="#" class="menu-link px-5">
						<span class="menu-title">My Subscription</span>
						<span class="menu-arrow"></span>
					</a>

					<!--begin::Menu sub-->
					<div class="menu-sub menu-sub-dropdown w-175px py-4">
						<!--begin::Menu item-->
						<div class="menu-item px-3">
							<a href="account/referrals.html" class="menu-link px-5">
								Referrals
							</a>
						</div>
						<!--end::Menu item-->

						<!--begin::Menu item-->
						<div class="menu-item px-3">
							<a href="account/billing.html" class="menu-link px-5">
								Billing
							</a>
						</div>
						<!--end::Menu item-->

						<!--begin::Menu item-->
						<div class="menu-item px-3">
							<a href="account/statements.html" class="menu-link px-5">
								Payments
							</a>
						</div>
						<!--end::Menu item-->

						<!--begin::Menu item-->
						<div class="menu-item px-3">
							<a href="account/statements.html" class="menu-link d-flex flex-stack px-5">
								Statements

								<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
									title="View your statements"></i>
							</a>
						</div>
						<!--end::Menu item-->

						<!--begin::Menu separator-->
						<div class="separator my-2"></div>
						<!--end::Menu separator-->

						<!--begin::Menu item-->
						<div class="menu-item px-3">
							<div class="menu-content px-3">
								<label class="form-check form-switch form-check-custom form-check-solid">
									<input class="form-check-input w-30px h-20px" type="checkbox" value="1"
										checked="checked" name="notifications" />
									<span class="form-check-label text-muted fs-7">
										Notifications
									</span>
								</label>
							</div>
						</div>
						<!--end::Menu item-->
					</div>
					<!--end::Menu sub-->
				</div>
				<!--end::Menu item-->

				<!--begin::Menu item-->
				<div class="menu-item px-5">
					<a href="account/statements.html" class="menu-link px-5">
						My Statements
					</a>
				</div>
				<!--end::Menu item-->

				<!--begin::Menu separator-->
				<div class="separator my-2"></div>
				<!--end::Menu separator--> --}}

				<!--begin::Menu item-->
				<div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
					data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
					<a href="#" class="menu-link px-5">
						<span class="menu-title position-relative">
							Mode

							<span class="ms-5 position-absolute translate-middle-y top-50 end-0">
								<!--begin::Svg Icon | path: icons/duotune/general/gen060.svg-->
								<span class="svg-icon theme-light-show svg-icon-2"><svg width="24" height="24"
										viewBox="0 0 24 24" fill="none" xmlns="../../../www.w3.org/2000/svg.html">
										<path
											d="M11.9905 5.62598C10.7293 5.62574 9.49646 5.9995 8.44775 6.69997C7.39903 7.40045 6.58159 8.39619 6.09881 9.56126C5.61603 10.7263 5.48958 12.0084 5.73547 13.2453C5.98135 14.4823 6.58852 15.6185 7.48019 16.5104C8.37186 17.4022 9.50798 18.0096 10.7449 18.2557C11.9818 18.5019 13.2639 18.3757 14.429 17.8931C15.5942 17.4106 16.5901 16.5933 17.2908 15.5448C17.9915 14.4962 18.3655 13.2634 18.3655 12.0023C18.3637 10.3119 17.6916 8.69129 16.4964 7.49593C15.3013 6.30056 13.6808 5.62806 11.9905 5.62598Z"
											fill="currentColor" />
										<path
											d="M22.1258 10.8771H20.627C20.3286 10.8771 20.0424 10.9956 19.8314 11.2066C19.6204 11.4176 19.5018 11.7038 19.5018 12.0023C19.5018 12.3007 19.6204 12.5869 19.8314 12.7979C20.0424 13.0089 20.3286 13.1274 20.627 13.1274H22.1258C22.4242 13.1274 22.7104 13.0089 22.9214 12.7979C23.1324 12.5869 23.2509 12.3007 23.2509 12.0023C23.2509 11.7038 23.1324 11.4176 22.9214 11.2066C22.7104 10.9956 22.4242 10.8771 22.1258 10.8771Z"
											fill="currentColor" />
										<path
											d="M11.9905 19.4995C11.6923 19.5 11.4064 19.6187 11.1956 19.8296C10.9848 20.0405 10.8663 20.3265 10.866 20.6247V22.1249C10.866 22.4231 10.9845 22.7091 11.1953 22.9199C11.4062 23.1308 11.6922 23.2492 11.9904 23.2492C12.2886 23.2492 12.5746 23.1308 12.7854 22.9199C12.9963 22.7091 13.1147 22.4231 13.1147 22.1249V20.6247C13.1145 20.3265 12.996 20.0406 12.7853 19.8296C12.5745 19.6187 12.2887 19.5 11.9905 19.4995Z"
											fill="currentColor" />
										<path
											d="M4.49743 12.0023C4.49718 11.704 4.37865 11.4181 4.16785 11.2072C3.95705 10.9962 3.67119 10.8775 3.37298 10.8771H1.87445C1.57603 10.8771 1.28984 10.9956 1.07883 11.2066C0.867812 11.4176 0.749266 11.7038 0.749266 12.0023C0.749266 12.3007 0.867812 12.5869 1.07883 12.7979C1.28984 13.0089 1.57603 13.1274 1.87445 13.1274H3.37299C3.6712 13.127 3.95706 13.0083 4.16785 12.7973C4.37865 12.5864 4.49718 12.3005 4.49743 12.0023Z"
											fill="currentColor" />
										<path
											d="M11.9905 4.50058C12.2887 4.50012 12.5745 4.38141 12.7853 4.17048C12.9961 3.95954 13.1147 3.67361 13.1149 3.3754V1.87521C13.1149 1.57701 12.9965 1.29103 12.7856 1.08017C12.5748 0.869313 12.2888 0.750854 11.9906 0.750854C11.6924 0.750854 11.4064 0.869313 11.1955 1.08017C10.9847 1.29103 10.8662 1.57701 10.8662 1.87521V3.3754C10.8664 3.67359 10.9849 3.95952 11.1957 4.17046C11.4065 4.3814 11.6923 4.50012 11.9905 4.50058Z"
											fill="currentColor" />
										<path
											d="M18.8857 6.6972L19.9465 5.63642C20.0512 5.53209 20.1343 5.40813 20.1911 5.27163C20.2479 5.13513 20.2772 4.98877 20.2774 4.84093C20.2775 4.69309 20.2485 4.54667 20.192 4.41006C20.1355 4.27344 20.0526 4.14932 19.948 4.04478C19.8435 3.94024 19.7194 3.85734 19.5828 3.80083C19.4462 3.74432 19.2997 3.71531 19.1519 3.71545C19.0041 3.7156 18.8577 3.7449 18.7212 3.80167C18.5847 3.85845 18.4607 3.94159 18.3564 4.04633L17.2956 5.10714C17.1909 5.21147 17.1077 5.33543 17.0509 5.47194C16.9942 5.60844 16.9649 5.7548 16.9647 5.90264C16.9646 6.05048 16.9936 6.19689 17.0501 6.33351C17.1066 6.47012 17.1895 6.59425 17.294 6.69878C17.3986 6.80332 17.5227 6.88621 17.6593 6.94272C17.7959 6.99923 17.9424 7.02824 18.0902 7.02809C18.238 7.02795 18.3844 6.99865 18.5209 6.94187C18.6574 6.88509 18.7814 6.80195 18.8857 6.6972Z"
											fill="currentColor" />
										<path
											d="M18.8855 17.3073C18.7812 17.2026 18.6572 17.1195 18.5207 17.0627C18.3843 17.006 18.2379 16.9767 18.0901 16.9766C17.9423 16.9764 17.7959 17.0055 17.6593 17.062C17.5227 17.1185 17.3986 17.2014 17.2941 17.3059C17.1895 17.4104 17.1067 17.5345 17.0501 17.6711C16.9936 17.8077 16.9646 17.9541 16.9648 18.1019C16.9649 18.2497 16.9942 18.3961 17.0509 18.5326C17.1077 18.6691 17.1908 18.793 17.2955 18.8974L18.3563 19.9582C18.4606 20.0629 18.5846 20.146 18.721 20.2027C18.8575 20.2595 19.0039 20.2887 19.1517 20.2889C19.2995 20.289 19.4459 20.26 19.5825 20.2035C19.7191 20.147 19.8432 20.0641 19.9477 19.9595C20.0523 19.855 20.1351 19.7309 20.1916 19.5943C20.2482 19.4577 20.2772 19.3113 20.277 19.1635C20.2769 19.0157 20.2476 18.8694 20.1909 18.7329C20.1341 18.5964 20.051 18.4724 19.9463 18.3681L18.8855 17.3073Z"
											fill="currentColor" />
										<path
											d="M5.09528 17.3072L4.0345 18.368C3.92972 18.4723 3.84655 18.5963 3.78974 18.7328C3.73294 18.8693 3.70362 19.0156 3.70346 19.1635C3.7033 19.3114 3.7323 19.4578 3.78881 19.5944C3.84532 19.7311 3.92822 19.8552 4.03277 19.9598C4.13732 20.0643 4.26147 20.1472 4.3981 20.2037C4.53473 20.2602 4.68117 20.2892 4.82902 20.2891C4.97688 20.2889 5.12325 20.2596 5.25976 20.2028C5.39627 20.146 5.52024 20.0628 5.62456 19.958L6.68536 18.8973C6.79007 18.7929 6.87318 18.6689 6.92993 18.5325C6.98667 18.396 7.01595 18.2496 7.01608 18.1018C7.01621 17.954 6.98719 17.8076 6.93068 17.671C6.87417 17.5344 6.79129 17.4103 6.68676 17.3058C6.58224 17.2012 6.45813 17.1183 6.32153 17.0618C6.18494 17.0053 6.03855 16.9763 5.89073 16.9764C5.74291 16.9766 5.59657 17.0058 5.46007 17.0626C5.32358 17.1193 5.19962 17.2024 5.09528 17.3072Z"
											fill="currentColor" />
										<path
											d="M5.09541 6.69715C5.19979 6.8017 5.32374 6.88466 5.4602 6.94128C5.59665 6.9979 5.74292 7.02708 5.89065 7.02714C6.03839 7.0272 6.18469 6.99815 6.32119 6.94164C6.45769 6.88514 6.58171 6.80228 6.68618 6.69782C6.79064 6.59336 6.87349 6.46933 6.93 6.33283C6.9865 6.19633 7.01556 6.05003 7.01549 5.9023C7.01543 5.75457 6.98625 5.60829 6.92963 5.47184C6.87301 5.33539 6.79005 5.21143 6.6855 5.10706L5.6247 4.04626C5.5204 3.94137 5.39643 3.8581 5.25989 3.80121C5.12335 3.74432 4.97692 3.71493 4.82901 3.71472C4.68109 3.71452 4.53458 3.7435 4.39789 3.80001C4.26119 3.85652 4.13699 3.93945 4.03239 4.04404C3.9278 4.14864 3.84487 4.27284 3.78836 4.40954C3.73185 4.54624 3.70287 4.69274 3.70308 4.84066C3.70329 4.98858 3.73268 5.135 3.78957 5.27154C3.84646 5.40808 3.92974 5.53205 4.03462 5.63635L5.09541 6.69715Z"
											fill="currentColor" />
									</svg>
								</span>
								<!--end::Svg Icon-->
								<!--begin::Svg Icon | path: icons/duotune/general/gen061.svg-->
								<span class="svg-icon theme-dark-show svg-icon-2"><svg width="24" height="24"
										viewBox="0 0 24 24" fill="none" xmlns="../../../www.w3.org/2000/svg.html">
										<path
											d="M19.0647 5.43757C19.3421 5.43757 19.567 5.21271 19.567 4.93534C19.567 4.65796 19.3421 4.43311 19.0647 4.43311C18.7874 4.43311 18.5625 4.65796 18.5625 4.93534C18.5625 5.21271 18.7874 5.43757 19.0647 5.43757Z"
											fill="currentColor" />
										<path
											d="M20.0692 9.48884C20.3466 9.48884 20.5714 9.26398 20.5714 8.98661C20.5714 8.70923 20.3466 8.48438 20.0692 8.48438C19.7918 8.48438 19.567 8.70923 19.567 8.98661C19.567 9.26398 19.7918 9.48884 20.0692 9.48884Z"
											fill="currentColor" />
										<path
											d="M12.0335 20.5714C15.6943 20.5714 18.9426 18.2053 20.1168 14.7338C20.1884 14.5225 20.1114 14.289 19.9284 14.161C19.746 14.034 19.5003 14.0418 19.3257 14.1821C18.2432 15.0546 16.9371 15.5156 15.5491 15.5156C12.2257 15.5156 9.48884 12.8122 9.48884 9.48886C9.48884 7.41079 10.5773 5.47137 12.3449 4.35752C12.5342 4.23832 12.6 4.00733 12.5377 3.79251C12.4759 3.57768 12.2571 3.42859 12.0335 3.42859C7.32556 3.42859 3.42857 7.29209 3.42857 12C3.42857 16.7079 7.32556 20.5714 12.0335 20.5714Z"
											fill="currentColor" />
										<path
											d="M13.0379 7.47998C13.8688 7.47998 14.5446 8.15585 14.5446 8.98668C14.5446 9.26428 14.7693 9.48891 15.0469 9.48891C15.3245 9.48891 15.5491 9.26428 15.5491 8.98668C15.5491 8.15585 16.225 7.47998 17.0558 7.47998C17.3334 7.47998 17.558 7.25535 17.558 6.97775C17.558 6.70015 17.3334 6.47552 17.0558 6.47552C16.225 6.47552 15.5491 5.76616 15.5491 4.93534C15.5491 4.65774 15.3245 4.43311 15.0469 4.43311C14.7693 4.43311 14.5446 4.65774 14.5446 4.93534C14.5446 5.76616 13.8688 6.47552 13.0379 6.47552C12.7603 6.47552 12.5357 6.70015 12.5357 6.97775C12.5357 7.25535 12.7603 7.47998 13.0379 7.47998Z"
											fill="currentColor" />
									</svg>
								</span>
								<!--end::Svg Icon-->
							</span>
						</span>
					</a>

					<!--begin::Menu-->
					<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-muted menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
						data-kt-menu="true" data-kt-element="theme-mode-menu">
						<!--begin::Menu item-->
						<div class="menu-item px-3 my-0">
							<a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
								<span class="menu-icon" data-kt-element="icon">
									<!--begin::Svg Icon | path: icons/duotune/general/gen060.svg-->
									<span class="svg-icon svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24"
											fill="none" xmlns="../../../www.w3.org/2000/svg.html">
											<path
												d="M11.9905 5.62598C10.7293 5.62574 9.49646 5.9995 8.44775 6.69997C7.39903 7.40045 6.58159 8.39619 6.09881 9.56126C5.61603 10.7263 5.48958 12.0084 5.73547 13.2453C5.98135 14.4823 6.58852 15.6185 7.48019 16.5104C8.37186 17.4022 9.50798 18.0096 10.7449 18.2557C11.9818 18.5019 13.2639 18.3757 14.429 17.8931C15.5942 17.4106 16.5901 16.5933 17.2908 15.5448C17.9915 14.4962 18.3655 13.2634 18.3655 12.0023C18.3637 10.3119 17.6916 8.69129 16.4964 7.49593C15.3013 6.30056 13.6808 5.62806 11.9905 5.62598Z"
												fill="currentColor" />
											<path
												d="M22.1258 10.8771H20.627C20.3286 10.8771 20.0424 10.9956 19.8314 11.2066C19.6204 11.4176 19.5018 11.7038 19.5018 12.0023C19.5018 12.3007 19.6204 12.5869 19.8314 12.7979C20.0424 13.0089 20.3286 13.1274 20.627 13.1274H22.1258C22.4242 13.1274 22.7104 13.0089 22.9214 12.7979C23.1324 12.5869 23.2509 12.3007 23.2509 12.0023C23.2509 11.7038 23.1324 11.4176 22.9214 11.2066C22.7104 10.9956 22.4242 10.8771 22.1258 10.8771Z"
												fill="currentColor" />
											<path
												d="M11.9905 19.4995C11.6923 19.5 11.4064 19.6187 11.1956 19.8296C10.9848 20.0405 10.8663 20.3265 10.866 20.6247V22.1249C10.866 22.4231 10.9845 22.7091 11.1953 22.9199C11.4062 23.1308 11.6922 23.2492 11.9904 23.2492C12.2886 23.2492 12.5746 23.1308 12.7854 22.9199C12.9963 22.7091 13.1147 22.4231 13.1147 22.1249V20.6247C13.1145 20.3265 12.996 20.0406 12.7853 19.8296C12.5745 19.6187 12.2887 19.5 11.9905 19.4995Z"
												fill="currentColor" />
											<path
												d="M4.49743 12.0023C4.49718 11.704 4.37865 11.4181 4.16785 11.2072C3.95705 10.9962 3.67119 10.8775 3.37298 10.8771H1.87445C1.57603 10.8771 1.28984 10.9956 1.07883 11.2066C0.867812 11.4176 0.749266 11.7038 0.749266 12.0023C0.749266 12.3007 0.867812 12.5869 1.07883 12.7979C1.28984 13.0089 1.57603 13.1274 1.87445 13.1274H3.37299C3.6712 13.127 3.95706 13.0083 4.16785 12.7973C4.37865 12.5864 4.49718 12.3005 4.49743 12.0023Z"
												fill="currentColor" />
											<path
												d="M11.9905 4.50058C12.2887 4.50012 12.5745 4.38141 12.7853 4.17048C12.9961 3.95954 13.1147 3.67361 13.1149 3.3754V1.87521C13.1149 1.57701 12.9965 1.29103 12.7856 1.08017C12.5748 0.869313 12.2888 0.750854 11.9906 0.750854C11.6924 0.750854 11.4064 0.869313 11.1955 1.08017C10.9847 1.29103 10.8662 1.57701 10.8662 1.87521V3.3754C10.8664 3.67359 10.9849 3.95952 11.1957 4.17046C11.4065 4.3814 11.6923 4.50012 11.9905 4.50058Z"
												fill="currentColor" />
											<path
												d="M18.8857 6.6972L19.9465 5.63642C20.0512 5.53209 20.1343 5.40813 20.1911 5.27163C20.2479 5.13513 20.2772 4.98877 20.2774 4.84093C20.2775 4.69309 20.2485 4.54667 20.192 4.41006C20.1355 4.27344 20.0526 4.14932 19.948 4.04478C19.8435 3.94024 19.7194 3.85734 19.5828 3.80083C19.4462 3.74432 19.2997 3.71531 19.1519 3.71545C19.0041 3.7156 18.8577 3.7449 18.7212 3.80167C18.5847 3.85845 18.4607 3.94159 18.3564 4.04633L17.2956 5.10714C17.1909 5.21147 17.1077 5.33543 17.0509 5.47194C16.9942 5.60844 16.9649 5.7548 16.9647 5.90264C16.9646 6.05048 16.9936 6.19689 17.0501 6.33351C17.1066 6.47012 17.1895 6.59425 17.294 6.69878C17.3986 6.80332 17.5227 6.88621 17.6593 6.94272C17.7959 6.99923 17.9424 7.02824 18.0902 7.02809C18.238 7.02795 18.3844 6.99865 18.5209 6.94187C18.6574 6.88509 18.7814 6.80195 18.8857 6.6972Z"
												fill="currentColor" />
											<path
												d="M18.8855 17.3073C18.7812 17.2026 18.6572 17.1195 18.5207 17.0627C18.3843 17.006 18.2379 16.9767 18.0901 16.9766C17.9423 16.9764 17.7959 17.0055 17.6593 17.062C17.5227 17.1185 17.3986 17.2014 17.2941 17.3059C17.1895 17.4104 17.1067 17.5345 17.0501 17.6711C16.9936 17.8077 16.9646 17.9541 16.9648 18.1019C16.9649 18.2497 16.9942 18.3961 17.0509 18.5326C17.1077 18.6691 17.1908 18.793 17.2955 18.8974L18.3563 19.9582C18.4606 20.0629 18.5846 20.146 18.721 20.2027C18.8575 20.2595 19.0039 20.2887 19.1517 20.2889C19.2995 20.289 19.4459 20.26 19.5825 20.2035C19.7191 20.147 19.8432 20.0641 19.9477 19.9595C20.0523 19.855 20.1351 19.7309 20.1916 19.5943C20.2482 19.4577 20.2772 19.3113 20.277 19.1635C20.2769 19.0157 20.2476 18.8694 20.1909 18.7329C20.1341 18.5964 20.051 18.4724 19.9463 18.3681L18.8855 17.3073Z"
												fill="currentColor" />
											<path
												d="M5.09528 17.3072L4.0345 18.368C3.92972 18.4723 3.84655 18.5963 3.78974 18.7328C3.73294 18.8693 3.70362 19.0156 3.70346 19.1635C3.7033 19.3114 3.7323 19.4578 3.78881 19.5944C3.84532 19.7311 3.92822 19.8552 4.03277 19.9598C4.13732 20.0643 4.26147 20.1472 4.3981 20.2037C4.53473 20.2602 4.68117 20.2892 4.82902 20.2891C4.97688 20.2889 5.12325 20.2596 5.25976 20.2028C5.39627 20.146 5.52024 20.0628 5.62456 19.958L6.68536 18.8973C6.79007 18.7929 6.87318 18.6689 6.92993 18.5325C6.98667 18.396 7.01595 18.2496 7.01608 18.1018C7.01621 17.954 6.98719 17.8076 6.93068 17.671C6.87417 17.5344 6.79129 17.4103 6.68676 17.3058C6.58224 17.2012 6.45813 17.1183 6.32153 17.0618C6.18494 17.0053 6.03855 16.9763 5.89073 16.9764C5.74291 16.9766 5.59657 17.0058 5.46007 17.0626C5.32358 17.1193 5.19962 17.2024 5.09528 17.3072Z"
												fill="currentColor" />
											<path
												d="M5.09541 6.69715C5.19979 6.8017 5.32374 6.88466 5.4602 6.94128C5.59665 6.9979 5.74292 7.02708 5.89065 7.02714C6.03839 7.0272 6.18469 6.99815 6.32119 6.94164C6.45769 6.88514 6.58171 6.80228 6.68618 6.69782C6.79064 6.59336 6.87349 6.46933 6.93 6.33283C6.9865 6.19633 7.01556 6.05003 7.01549 5.9023C7.01543 5.75457 6.98625 5.60829 6.92963 5.47184C6.87301 5.33539 6.79005 5.21143 6.6855 5.10706L5.6247 4.04626C5.5204 3.94137 5.39643 3.8581 5.25989 3.80121C5.12335 3.74432 4.97692 3.71493 4.82901 3.71472C4.68109 3.71452 4.53458 3.7435 4.39789 3.80001C4.26119 3.85652 4.13699 3.93945 4.03239 4.04404C3.9278 4.14864 3.84487 4.27284 3.78836 4.40954C3.73185 4.54624 3.70287 4.69274 3.70308 4.84066C3.70329 4.98858 3.73268 5.135 3.78957 5.27154C3.84646 5.40808 3.92974 5.53205 4.03462 5.63635L5.09541 6.69715Z"
												fill="currentColor" />
										</svg>
									</span>
									<!--end::Svg Icon-->
								</span>
								<span class="menu-title">
									Light
								</span>
							</a>
						</div>
						<!--end::Menu item-->

						<!--begin::Menu item-->
						<div class="menu-item px-3 my-0">
							<a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
								<span class="menu-icon" data-kt-element="icon">
									<!--begin::Svg Icon | path: icons/duotune/general/gen061.svg-->
									<span class="svg-icon svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24"
											fill="none" xmlns="../../../www.w3.org/2000/svg.html">
											<path
												d="M19.0647 5.43757C19.3421 5.43757 19.567 5.21271 19.567 4.93534C19.567 4.65796 19.3421 4.43311 19.0647 4.43311C18.7874 4.43311 18.5625 4.65796 18.5625 4.93534C18.5625 5.21271 18.7874 5.43757 19.0647 5.43757Z"
												fill="currentColor" />
											<path
												d="M20.0692 9.48884C20.3466 9.48884 20.5714 9.26398 20.5714 8.98661C20.5714 8.70923 20.3466 8.48438 20.0692 8.48438C19.7918 8.48438 19.567 8.70923 19.567 8.98661C19.567 9.26398 19.7918 9.48884 20.0692 9.48884Z"
												fill="currentColor" />
											<path
												d="M12.0335 20.5714C15.6943 20.5714 18.9426 18.2053 20.1168 14.7338C20.1884 14.5225 20.1114 14.289 19.9284 14.161C19.746 14.034 19.5003 14.0418 19.3257 14.1821C18.2432 15.0546 16.9371 15.5156 15.5491 15.5156C12.2257 15.5156 9.48884 12.8122 9.48884 9.48886C9.48884 7.41079 10.5773 5.47137 12.3449 4.35752C12.5342 4.23832 12.6 4.00733 12.5377 3.79251C12.4759 3.57768 12.2571 3.42859 12.0335 3.42859C7.32556 3.42859 3.42857 7.29209 3.42857 12C3.42857 16.7079 7.32556 20.5714 12.0335 20.5714Z"
												fill="currentColor" />
											<path
												d="M13.0379 7.47998C13.8688 7.47998 14.5446 8.15585 14.5446 8.98668C14.5446 9.26428 14.7693 9.48891 15.0469 9.48891C15.3245 9.48891 15.5491 9.26428 15.5491 8.98668C15.5491 8.15585 16.225 7.47998 17.0558 7.47998C17.3334 7.47998 17.558 7.25535 17.558 6.97775C17.558 6.70015 17.3334 6.47552 17.0558 6.47552C16.225 6.47552 15.5491 5.76616 15.5491 4.93534C15.5491 4.65774 15.3245 4.43311 15.0469 4.43311C14.7693 4.43311 14.5446 4.65774 14.5446 4.93534C14.5446 5.76616 13.8688 6.47552 13.0379 6.47552C12.7603 6.47552 12.5357 6.70015 12.5357 6.97775C12.5357 7.25535 12.7603 7.47998 13.0379 7.47998Z"
												fill="currentColor" />
										</svg>
									</span>
									<!--end::Svg Icon-->
								</span>
								<span class="menu-title">
									Dark
								</span>
							</a>
						</div>
						<!--end::Menu item-->

						<!--begin::Menu item-->
						<div class="menu-item px-3 my-0">
							<a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
								<span class="menu-icon" data-kt-element="icon">
									<!--begin::Svg Icon | path: icons/duotune/general/gen062.svg-->
									<span class="svg-icon svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24"
											fill="none" xmlns="../../../www.w3.org/2000/svg.html">
											<path fill-rule="evenodd" clip-rule="evenodd"
												d="M1.34375 3.9463V15.2178C1.34375 16.119 2.08105 16.8563 2.98219 16.8563H8.65093V19.4594H6.15702C5.38853 19.4594 4.75981 19.9617 4.75981 20.5757V21.6921H19.2403V20.5757C19.2403 19.9617 18.6116 19.4594 17.8431 19.4594H15.3492V16.8563H21.0179C21.919 16.8563 22.6562 16.119 22.6562 15.2178V3.9463C22.6562 3.04516 21.9189 2.30786 21.0179 2.30786H2.98219C2.08105 2.30786 1.34375 3.04516 1.34375 3.9463ZM12.9034 9.9016C13.241 9.98792 13.5597 10.1216 13.852 10.2949L15.0393 9.4353L15.9893 10.3853L15.1297 11.5727C15.303 11.865 15.4366 12.1837 15.523 12.5212L16.97 12.7528V13.4089H13.9851C13.9766 12.3198 13.0912 11.4394 12 11.4394C10.9089 11.4394 10.0235 12.3198 10.015 13.4089H7.03006V12.7528L8.47712 12.5211C8.56345 12.1836 8.69703 11.8649 8.87037 11.5727L8.0107 10.3853L8.96078 9.4353L10.148 10.2949C10.4404 10.1215 10.759 9.98788 11.0966 9.9016L11.3282 8.45467H12.6718L12.9034 9.9016ZM16.1353 7.93758C15.6779 7.93758 15.3071 7.56681 15.3071 7.1094C15.3071 6.652 15.6779 6.28122 16.1353 6.28122C16.5926 6.28122 16.9634 6.652 16.9634 7.1094C16.9634 7.56681 16.5926 7.93758 16.1353 7.93758ZM2.71385 14.0964V3.90518C2.71385 3.78023 2.81612 3.67796 2.94107 3.67796H21.0589C21.1839 3.67796 21.2861 3.78023 21.2861 3.90518V14.0964C15.0954 14.0964 8.90462 14.0964 2.71385 14.0964Z"
												fill="currentColor" />
										</svg>
									</span>
									<!--end::Svg Icon-->
								</span>
								<span class="menu-title">
									System
								</span>
							</a>
						</div>
						<!--end::Menu item-->
					</div>
					<!--end::Menu-->

				</div>
				<!--end::Menu item-->

				{{-- <!--begin::Menu item-->
				<div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
					data-kt-menu-placement="right-end" data-kt-menu-offset="-15px, 0">
					<a href="#" class="menu-link px-5">
						<span class="menu-title position-relative">
							Language

							<span
								class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">
								English <img class="w-15px h-15px rounded-1 ms-2"
									src="assets/media/flags/united-states.svg" alt="" />
							</span>
						</span>
					</a>

					<!--begin::Menu sub-->
					<div class="menu-sub menu-sub-dropdown w-175px py-4">
						<!--begin::Menu item-->
						<div class="menu-item px-3">
							<a href="account/settings.html" class="menu-link d-flex px-5 active">
								<span class="symbol symbol-20px me-4">
									<img class="rounded-1" src="assets/media/flags/united-states.svg" alt="" />
								</span>
								English
							</a>
						</div>
						<!--end::Menu item-->

						<!--begin::Menu item-->
						<div class="menu-item px-3">
							<a href="account/settings.html" class="menu-link d-flex px-5">
								<span class="symbol symbol-20px me-4">
									<img class="rounded-1" src="assets/media/flags/spain.svg" alt="" />
								</span>
								Spanish
							</a>
						</div>
						<!--end::Menu item-->

						<!--begin::Menu item-->
						<div class="menu-item px-3">
							<a href="account/settings.html" class="menu-link d-flex px-5">
								<span class="symbol symbol-20px me-4">
									<img class="rounded-1" src="assets/media/flags/germany.svg" alt="" />
								</span>
								German
							</a>
						</div>
						<!--end::Menu item-->

						<!--begin::Menu item-->
						<div class="menu-item px-3">
							<a href="account/settings.html" class="menu-link d-flex px-5">
								<span class="symbol symbol-20px me-4">
									<img class="rounded-1" src="assets/media/flags/japan.svg" alt="" />
								</span>
								Japanese
							</a>
						</div>
						<!--end::Menu item-->

						<!--begin::Menu item-->
						<div class="menu-item px-3">
							<a href="account/settings.html" class="menu-link d-flex px-5">
								<span class="symbol symbol-20px me-4">
									<img class="rounded-1" src="assets/media/flags/france.svg" alt="" />
								</span>
								French
							</a>
						</div>
						<!--end::Menu item-->
					</div>
					<!--end::Menu sub-->
				</div>
				<!--end::Menu item--> --}}

				{{-- <!--begin::Menu item-->
				<div class="menu-item px-5 my-1">
					<a href="account/settings.html" class="menu-link px-5">
						Account Settings
					</a>
				</div>
				<!--end::Menu item--> --}}

				<!--begin::Menu item-->
				<div class="menu-item px-5">
					<a href="authentication/layouts/corporate/sign-in.html" class="menu-link px-5">
						Sign Out
					</a>
				</div>
				<!--end::Menu item-->
			</div>
			<!--end::User account menu-->
			<!--end::Menu wrapper-->
		</div>
		<!--end::User menu-->

		<!--begin::Logout-->
		<a class="btn btn-sm btn-outline btn-flex btn-custom px-3" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
							>
			<!--begin::Svg Icon | path: icons/duotune/arrows/arr076.svg-->
			<span class="svg-icon svg-icon-3 me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
					xmlns="../../../www.w3.org/2000/svg.html">
					<rect opacity="0.3" width="12" height="2" rx="1" transform="matrix(-1 0 0 1 15.5 11)"
						fill="currentColor" />
					<path
						d="M13.6313 11.6927L11.8756 10.2297C11.4054 9.83785 11.3732 9.12683 11.806 8.69401C12.1957 8.3043 12.8216 8.28591 13.2336 8.65206L16.1592 11.2526C16.6067 11.6504 16.6067 12.3496 16.1592 12.7474L13.2336 15.3479C12.8216 15.7141 12.1957 15.6957 11.806 15.306C11.3732 14.8732 11.4054 14.1621 11.8756 13.7703L13.6313 12.3073C13.8232 12.1474 13.8232 11.8526 13.6313 11.6927Z"
						fill="currentColor" />
					<path
						d="M8 5V6C8 6.55228 8.44772 7 9 7C9.55228 7 10 6.55228 10 6C10 5.44772 10.4477 5 11 5H18C18.5523 5 19 5.44772 19 6V18C19 18.5523 18.5523 19 18 19H11C10.4477 19 10 18.5523 10 18C10 17.4477 9.55228 17 9 17C8.44772 17 8 17.4477 8 18V19C8 20.1046 8.89543 21 10 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3H10C8.89543 3 8 3.89543 8 5Z"
						fill="currentColor" />
				</svg>
			</span>
			<!--end::Svg Icon-->
			Sign Out</a>
			<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
				@csrf
			</form>
		<!--end::Logout-->
	</div>
	<!--end::Footer-->
</div>
<!--end::Sidebar-->