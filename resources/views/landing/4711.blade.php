<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Barhive Demo</title>
    <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet"/>

    <style>
        html {
            height: 100%;
            background: #38aecc;
            background: linear-gradient(360deg, #38aecc 10%, #347fb9 360%);
        }


        /* JUST FOR DEMO DATA */
        .browser-mockup {
            border-top: 2em solid rgba(230, 230, 230, 0.7);
            position: relative;
            height: 40vh;
        }
        .browser-mockup:before {
            display: block;
            position: absolute;
            content: "";
            top: -1.25em;
            left: 1em;
            width: 0.5em;
            height: 0.5em;
            border-radius: 50%;
            background-color: #f44;
            box-shadow: 0 0 0 2px #f44, 1.5em 0 0 2px #9b3, 3em 0 0 2px #fb5;
        }
        .browser-mockup > * {
            display: block;
        }
    </style>
</head>

<body class="text-white">
    <nav id="header" class="w-full z-30 top-0 py-1 lg:py-6">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-2 lg:py-6">
            <div class="pl-4 flex items-center">
                <a
                    class="text-white no-underline hover:no-underline font-bold text-2xl lg:text-4xl"
                    href="#">
                    <span class="text-yellow-400">★</span>
                    BarHive POS
                </a>
            </div>

            <div class="block lg:hidden pr-4">
                <button
                    id="nav-toggle"
                    class="flex items-center px-3 py-2 border rounded border-gray-600 hover:text-gray-800 hover:border-teal-500 appearance-none focus:outline-none">
                    <svg
                        class="fill-current h-3 w-3"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
                    </svg>
                </button>
            </div>

            <div
                class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-0 p-4 lg:p-0 z-20"
                id="nav-content">
                <ul class="list-reset lg:flex justify-end flex-1 items-center">
                    <li class="mr-3">
                        <a
                            class="inline-block py-2 px-4 font-bold no-underline"
                            href="/dashboard"
                        >Dashboard</a>
                    </li>
                    <li class="mr-3">
                        <a
                            class="inline-block no-underline hover:text-gray-800 hover:text-underline py-2 px-4"
                            href="/login">Login</a>
                    </li>
                    <li class="mr-3">
                        <a
                            class="inline-block no-underline hover:text-gray-800 hover:text-underline py-2 px-4"
                            href="/register">Register</a>
                    </li>
                    <li class="mr-3">
                        <a
                            class="inline-block no-underline hover:text-gray-800 hover:text-underline py-2 px-4"
                            href="/register">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mx-auto">
        <div class="text-center px-3 lg:px-0">
            <h1 class="my-3 text-2xl md:text-3xl lg:text-5xl font-black leading-tight">
                Lorem impsum dolor si tu!
            </h1>

            <div class="flex flex-wrap p-4">
                <div class="browser-mockup bg-white rounded shadow-xl w-full md:w-1/2 mx-auto my-4"></div>
            </div>

            <p class="leading-normal text-white text-base md:text-xl lg:text-2xl mb-8">
                Barhive is an open source project that implements a simple to use distributed point-of-sales (POS) system. This system is fit to be used by small hospitality industry businesses who wan't to adopt a modern sales process without investing in a physical POS system. Barhive is designed to run on any smartphone, table, or laptop.
            </p>

            <div class="text-center mt-12">
                <a href="/dashboard" class="bg-yellow-500 hover:bg-yellow-300 hover:text-grey-800 text-gray-800 font-bold py-2 px-4 rounded">Dashboard</a>
            </div>
        </div>
    </div>

    <script>
        var navMenuDiv = document.getElementById("nav-content");
        var navMenu = document.getElementById("nav-toggle");

        document.onclick = check;
        function check(e) {
            var target = (e && e.target) || (event && event.srcElement);

            //Nav Menu
            if (!checkParent(target, navMenuDiv)) {
                // click NOT on the menu
                if (checkParent(target, navMenu)) {
                    // click on the link
                    if (navMenuDiv.classList.contains("hidden")) {
                        navMenuDiv.classList.remove("hidden");
                    } else {
                        navMenuDiv.classList.add("hidden");
                    }
                } else {
                    // click both outside link and outside menu, hide menu
                    navMenuDiv.classList.add("hidden");
                }
            }
        }
        function checkParent(t, elm) {
            while (t.parentNode) {
                if (t == elm) {
                    return true;
                }
                t = t.parentNode;
            }
            return false;
        }
    </script>
</body>
</html>
