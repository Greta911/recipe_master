<!DOCTYPE html>
<html lang="fr">

@include('template.partials._head')

<body
    class="bg-gray-100 text-gray-800 font-sans leading-normal tracking-normal">
    @livewireScriptConfig
    <!-- Header -->
    @include('template.partials._nav')

    <!-- Main -->
    <!-- ... (reste du code précédent) ... -->

    <!-- Main -->
    <div class="container mx-auto flex flex-wrap pt-4 pb-12 text-gray-800">
        <!-- Filters -->
        @include('template.partials._aside')

        <!-- Main content -->
        <main class="w-full md:w-3/4 p-3">
            <!-- Hero Recipe Card -->
            <section class="relative mb-6">

                @yield('main_content')

            </section>
        </main>
    </div>

    <!-- ... (reste du code précédent) ... -->

    <!-- Footer -->
    @include('template.partials._footer')
</body>

</html>