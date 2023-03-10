<script src="{{ asset('dashboard_assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('dashboard_assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->
<script src="{{ asset('dashboard_assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{ asset('dashboard_assets/js/custom/widgets.js') }}"></script>
<script src="{{ asset('dashboard_assets/js/custom/apps/chat/chat.js') }}"></script>
<script src="{{ asset('dashboard_assets/js/custom/modals/create-app.js') }}"></script>
<script src="{{ asset('dashboard_assets/js/custom/modals/upgrade-plan.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@yield('js')
