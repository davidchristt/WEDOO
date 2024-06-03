<div>
    <style>
        .navbar-bg {
            position: relative;
            background-color: #D9D9D9; /* Light grey color */
        }
    </style>

    <!-- Navbar start -->
    <nav class="navbar-bg sticky top-0 z-50 w-full p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <div class="text-3xl font-bold text-black mr-6">
                    WEDOO!
                </div>
            </div>
            <ul class="hidden md:flex space-x-6 text-lg">
                <li><a wire:navigate href="/" class="text-black hover:text-gray-700">HOME</a></li>
                <li><a href="/transaksi" class="text-gray-400 hover:text-gray-700">TRANSAKSI</a></li>
                <li><a href="/contact" class="text-gray-400 hover:text-gray-700">CONTACT</a></li>
            </ul>
        </div>
    </nav>
    <!-- Navbar end -->

    <!-- Sidebar start -->
    <div id="containerSidebar" class="flex">
        <nav id="sidebar" class="fixed top-0 h-full bg-pink-700 transform -translate-x-full transition-transform duration-300 md:translate-x-0">
            <!-- one category / navigation group -->
            <div class="px-4 pb-0 py-20">
                <ul class="text-lg font-medium space-y-2">
                    <li>
                        <a class="flex items-center rounded py-3 pl-3 pr-4 text-gray-50 hover:bg-pink-600" href="/">
                            <span class="select-none">Back</span>
                        </a>
                    </li>
                    <li>
                        <a class="flex items-center rounded py-3 pl-3 pr-4 text-gray-50 hover:bg-pink-600" href="/Mobil">
                            <span class="select-none">Mobil</span>
                        </a>
                    </li>
                    <li>
                        <a class="flex items-center rounded py-3 pl-3 pr-4 text-gray-50 hover:bg-pink-600" href="/souvenir">
                            <span class="select-none">Souvenir</span>
                        </a>
                    </li>
                    <li>
                        <a class="flex items-center rounded py-3 pl-3 pr-4 text-gray-50 hover:bg-pink-600" href="/venue">
                            <span class="select-none">Venue</span>
                        </a>
                    </li>
                    <li>
                        <a class="flex items-center rounded py-3 pl-3 pr-4 text-gray-50 hover:bg-pink-600" href="/catering">
                            <span class="select-none">Catering</span>
                        </a>
                    </li>
                    <li>
                        <a class="flex items-center rounded py-3 pl-3 pr-4 text-gray-50 hover:bg-pink-600" href="/dokumentasi">
                            <span class="select-none">Dokumentasi</span>
                        </a>
                    </li>
                    <li>
                        <a class="flex items-center rounded py-3 pl-3 pr-4 text-gray-50 hover:bg-pink-600" href="/entertainment">
                            <span class="select-none">Entertainment</span>
                        </a>
                    </li>
                    <li>
                        <a class="flex items-center rounded py-3 pl-3 pr-4 text-gray-50 hover:bg-pink-600" href="/dekorasi">
                            <span class="select-none">Dekorasi</span>
                        </a>
                    </li>
                    <li>
                        <a class="flex items-center rounded py-3 pl-3 pr-4 text-gray-50 hover:bg-pink-600" href="/mc">
                            <span class="select-none">MC</span>
                        </a>
                    </li>
                    <li>
                        <a class="flex items-center rounded py-3 pl-3 pr-4 text-gray-50 hover:bg-pink-600" href="/perias">
                            <span class="select-none">Perias</span>
                        </a>
                    </li>
                    <li>
                        <a class="flex items-center rounded py-3 pl-3 pr-4 text-gray-50 hover:bg-pink-600" href="/akomodasi">
                            <span class="select-none">Akomodasi</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- navigation group end-->
        </nav>
    </div>
    <!-- Sidebar end -->

</div>
