<div class="p-6 space-y-6">
    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-500">
        {{ $breadcrumb }}
    </nav>

    <!-- Welcome Card -->
    <div class="bg-white rounded-xl border border-gray-200 px-8 py-10 shadow-sm">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">
            {{ $title }}
        </h2>
        <p class="text-gray-600 leading-relaxed text-sm">
            {{ $slot }}
        </p>
    </div>
</div>

