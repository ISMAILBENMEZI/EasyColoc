<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>How EasyColoc Works | Smart Flatsharing</title>

    <link href="https://fonts.bunny.net/css?family=syne:700,800|instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .step-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .step-card:hover {
            transform: translateY(-12px) scale(1.02);
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }

            100% {
                transform: translateY(0px);
            }
        }
    </style>
</head>

<body class="bg-[#fcfcfd] font-['Instrument_Sans'] antialiased text-[#1a1625] overflow-x-hidden">

    <div class="fixed -top-24 -right-24 w-96 h-96 bg-blue-100 rounded-full blur-[120px] opacity-50 -z-10"></div>
    <div class="fixed top-1/2 -left-24 w-72 h-72 bg-purple-100 rounded-full blur-[100px] opacity-40 -z-10"></div>

    <nav class="p-6 animate__animated animate__fadeIn">
        <a href="{{ url('/') }}" class="group inline-flex items-center text-blue-600 font-bold transition-all">
            <div class="p-2 rounded-full group-hover:bg-blue-50 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m15 18-6-6 6-6" />
                </svg>
            </div>
            <span class="ml-1 group-hover:ml-3 transition-all">Back to Home</span>
        </a>
    </nav>

    <header class="max-w-4xl mx-auto px-6 text-center py-16 animate__animated animate__zoomIn">
        <div
            class="inline-block px-4 py-1.5 bg-blue-50 text-blue-600 rounded-full text-sm font-black mb-6 tracking-widest uppercase">
            The Process
        </div>
        <h1 class="text-6xl lg:text-7xl font-black tracking-tighter font-['Syne'] mb-8 leading-[0.9]">
            Smart Living, <br><span class="text-blue-600">Simple Math.</span>
        </h1>
        <p class="text-xl text-gray-500 font-medium max-w-2xl mx-auto leading-relaxed">
            EasyColoc automates your shared expenses so you can focus on building memories, not debt.
        </p>
    </header>

    <section class="max-w-6xl mx-auto px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <div
                class="step-card p-10 bg-white rounded-[40px] border border-gray-100 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] animate__animated animate__fadeInLeft">
                <div
                    class="w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center text-white mb-8 shadow-xl shadow-blue-200 font-black text-2xl rotate-3">
                    1</div>
                <h3 class="text-3xl font-black font-['Syne'] mb-4 tracking-tight">Create & Invite</h3>
                <p class="text-gray-500 leading-relaxed font-medium text-lg">
                    Launch your colocation as an <strong>Owner</strong>. Send secure magic links to your roommates.
                    Simple, fast, and exclusive.
                </p>
            </div>

            <div
                class="step-card p-10 bg-blue-600 rounded-[40px] border border-blue-500 shadow-xl shadow-blue-100 animate__animated animate__fadeInRight">
                <div
                    class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-blue-600 mb-8 font-black text-2xl -rotate-3">
                    2</div>
                <h3 class="text-3xl font-black font-['Syne'] mb-4 tracking-tight text-white">Track Expenses</h3>
                <p class="text-blue-50 leading-relaxed font-medium text-lg">
                    Groceries, WiFi, or Water bills? Add them in seconds. We handle the split and update balances in
                    real-time.
                </p>
            </div>

            <div
                class="step-card p-10 bg-[#1a1625] rounded-[40px] shadow-2xl animate__animated animate__fadeInLeft animate__delay-1s">
                <div
                    class="w-16 h-16 bg-blue-500 rounded-2xl flex items-center justify-center text-white mb-8 font-black text-2xl rotate-6">
                    3</div>
                <h3 class="text-3xl font-black font-['Syne'] mb-4 tracking-tight text-white">Auto Balances</h3>
                <p class="text-gray-400 leading-relaxed font-medium text-lg">
                    The <strong>"Who owes who"</strong> engine simplifies complex debts into the fewest possible
                    payments. No more confusion.
                </p>
            </div>

            <div
                class="step-card p-10 bg-white rounded-[40px] border border-gray-100 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] animate__animated animate__fadeInRight animate__delay-1s">
                <div
                    class="w-16 h-16 bg-emerald-500 rounded-2xl flex items-center justify-center text-white mb-8 shadow-xl shadow-emerald-100 font-black text-2xl -rotate-6 text-white">
                    4</div>
                <h3 class="text-3xl font-black font-['Syne'] mb-4 tracking-tight">Earn Trust</h3>
                <p class="text-gray-500 leading-relaxed font-medium text-lg">
                    Your financial behavior builds your <strong>Reputation Score</strong>. Pay on time, leave debt-free,
                    and become a top-rated roommate.
                </p>
            </div>

        </div>
    </section>

    <section class="max-w-5xl mx-auto px-6 py-24">
        <div
            class="relative bg-blue-600 rounded-[60px] p-12 lg:p-20 overflow-hidden shadow-2xl shadow-blue-200 animate__animated animate__fadeInUp">
            <div class="absolute -bottom-10 -right-10 text-white/10 floating">
                <svg xmlns="http://www.w3.org/2000/svg" width="300" height="300" fill="currentColor"
                    viewBox="0 0 16 16">
                    <path
                        d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724C2.312 10.642 3.282 10 5 10c.05 0 .1 0 .148.005L4.92 10ZM1 5.083c.058-.085.122-.162.192-.233.033-.035.067-.067.102-.098L1 5.083ZM6 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm1-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
            </div>

            <div class="relative z-10">
                <h2 class="text-4xl lg:text-5xl font-black font-['Syne'] text-white mb-12 leading-tight">Financial Fair
                    Play</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="group">
                        <h4
                            class="text-xl font-bold text-blue-100 mb-3 flex items-center uppercase tracking-widest text-xs">
                            <span
                                class="w-2 h-2 bg-white rounded-full mr-2 group-hover:scale-150 transition-transform"></span>
                            Scenario: Leaving Early
                        </h4>
                        <p class="text-white text-lg font-medium opacity-90 leading-relaxed">
                            Leaving with debt? Your reputation drops to <span
                                class="bg-red-500 px-2 py-0.5 rounded">-1</span> and debts are redistributed. No one
                            loses money.
                        </p>
                    </div>
                    <div class="group">
                        <h4
                            class="text-xl font-bold text-blue-100 mb-3 flex items-center uppercase tracking-widest text-xs">
                            <span
                                class="w-2 h-2 bg-white rounded-full mr-2 group-hover:scale-150 transition-transform"></span>
                            Scenario: Member Removal
                        </h4>
                        <p class="text-white text-lg font-medium opacity-90 leading-relaxed">
                            If an Owner kicks a member out, the Owner <span
                                class="bg-emerald-500 px-2 py-0.5 rounded">takes responsibility</span> for their debts.
                            Power comes with duty.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="text-center pb-20 mt-10">
        <div class="inline-block transition-transform duration-500 hover:scale-105">
            <a href="{{ route('register') }}"
                class="group relative inline-flex items-center justify-center px-12 py-5 bg-[#1a1625] text-white rounded-[24px] font-black text-xl shadow-xl transition-all duration-500 hover:bg-blue-600 hover:shadow-blue-200 active:scale-95 overflow-hidden">

                <span class="relative z-10 transition-transform duration-500 group-hover:-translate-y-1">
                    Get Started Now
                </span>

                <div
                    class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:animate-[shimmer_2s_infinite] transition-transform">
                </div>

                <div
                    class="absolute inset-0 bg-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                </div>
            </a>
        </div>

        <p class="text-gray-400 mt-6 font-bold text-xs uppercase tracking-[0.3em] opacity-50">
            EasyColoc • Smart Management
        </p>
    </footer>

</body>

</html>
