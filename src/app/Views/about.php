<?= view('layout/header', ['title' => 'About - AI Insights & OpenAI Models', 'activeNav' => 'about']) ?>

<section class="pt-28 pb-20 bg-gray-900 min-h-screen">
    <div class="w-full max-w-5xl mx-auto px-6">

        <!-- Hero -->
        <div class="bg-gradient-to-br from-gray-800 via-gray-800 to-lime-900/20 rounded-2xl shadow-2xl p-8 md:p-10 mb-8">
            <h1 class="text-4xl font-bold text-white mb-2">OpenAI & The AI Revolution</h1>
            <p class="text-lg text-lime-500">Latest Models, Breakthroughs & Insights — July 2026</p>
            <p class="text-sm text-gray-400 mt-3">A comprehensive overview of OpenAI's model ecosystem, from GPT-3.5 to the latest GPT-5.6 series, covering reasoning, coding, multimodal capabilities, and the future of artificial intelligence.</p>
        </div>

        <!-- Recent Activity -->
        <div class="bg-gray-800 rounded-2xl shadow-2xl p-8 md:p-10 mb-8">
            <h2 class="text-2xl font-bold text-white border-b border-gray-700 pb-3 mb-6">
                <i class="fas fa-clock-rotate-left text-lime-500 mr-2"></i>Recent Activity
            </h2>
            <div class="relative">
                <!-- Timeline Line -->
                <div class="absolute left-5 top-0 bottom-0 w-px bg-gray-700"></div>

                <div class="space-y-6">
                    <div class="flex gap-4 relative">
                        <div class="w-10 h-10 bg-lime-500 rounded-full flex items-center justify-center shrink-0 z-10">
                            <i class="fas fa-code text-gray-900 text-sm"></i>
                        </div>
                        <div class="bg-gray-900/50 rounded-xl p-4 border border-gray-700 flex-1">
                            <div class="flex items-center gap-3 flex-wrap">
                                <span class="text-white font-semibold text-sm">Shipped GPT-5.6 Sol, Terra & Luna</span>
                                <span class="text-xs text-gray-500">Jun 26, 2026</span>
                            </div>
                            <p class="text-sm text-gray-400 mt-1">OpenAI released three GPT-5.6 variants — Sol (frontier), Terra (balanced), Luna (cost-optimized). Terra holds the record on BullshitBench v2 at 53%.</p>
                        </div>
                    </div>

                    <div class="flex gap-4 relative">
                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center shrink-0 z-10">
                            <i class="fas fa-microchip text-gray-900 text-sm"></i>
                        </div>
                        <div class="bg-gray-900/50 rounded-xl p-4 border border-gray-700 flex-1">
                            <div class="flex items-center gap-3 flex-wrap">
                                <span class="text-white font-semibold text-sm">GPT-5.5 Sets New Benchmarks</span>
                                <span class="text-xs text-gray-500">Apr 23, 2026</span>
                            </div>
                            <p class="text-sm text-gray-400 mt-1">SWE-Bench Pro 58.6%, ARC-AGI-2 84.6%, OSWorld-Verified 78.7%, Humanity's Last Exam 41.4% — highest scores across all major reasoning benchmarks.</p>
                        </div>
                    </div>

                    <div class="flex gap-4 relative">
                        <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center shrink-0 z-10">
                            <i class="fas fa-brain text-gray-900 text-sm"></i>
                        </div>
                        <div class="bg-gray-900/50 rounded-xl p-4 border border-gray-700 flex-1">
                            <div class="flex items-center gap-3 flex-wrap">
                                <span class="text-white font-semibold text-sm">GPT-5.4 with Extended Thinking</span>
                                <span class="text-xs text-gray-500">Mar 5, 2026</span>
                            </div>
                            <p class="text-sm text-gray-400 mt-1">Integrated coding from GPT-5.3-Codex. Thinking mode shows its plan upfront — allows mid-response course correction for complex tasks.</p>
                        </div>
                    </div>

                    <div class="flex gap-4 relative">
                        <div class="w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center shrink-0 z-10">
                            <i class="fas fa-terminal text-gray-900 text-sm"></i>
                        </div>
                        <div class="bg-gray-900/50 rounded-xl p-4 border border-gray-700 flex-1">
                            <div class="flex items-center gap-3 flex-wrap">
                                <span class="text-white font-semibold text-sm">GPT-5.3-Codex & Codex-Spark</span>
                                <span class="text-xs text-gray-500">Feb 5-12, 2026</span>
                            </div>
                            <p class="text-sm text-gray-400 mt-1">Dedicated coding models with dynamic thinking for autonomous software engineering. Spark variant optimized for rapid iteration.</p>
                        </div>
                    </div>

                    <div class="flex gap-4 relative">
                        <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center shrink-0 z-10">
                            <i class="fas fa-rocket text-gray-900 text-sm"></i>
                        </div>
                        <div class="bg-gray-900/50 rounded-xl p-4 border border-gray-700 flex-1">
                            <div class="flex items-center gap-3 flex-wrap">
                                <span class="text-white font-semibold text-sm">GPT-5 Launches as Free</span>
                                <span class="text-xs text-gray-500">Aug 7, 2025</span>
                            </div>
                            <p class="text-sm text-gray-400 mt-1">Unified system with smart routing. 94.6% AIME 2025, 74.9% SWE-bench, 45% fewer hallucinations than GPT-4o. Free for all ChatGPT users with unlimited messages.</p>
                        </div>
                    </div>

                    <div class="flex gap-4 relative">
                        <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center shrink-0 z-10">
                            <i class="fas fa-lock-open text-gray-900 text-sm"></i>
                        </div>
                        <div class="bg-gray-900/50 rounded-xl p-4 border border-gray-700 flex-1">
                            <div class="flex items-center gap-3 flex-wrap">
                                <span class="text-white font-semibold text-sm">OpenAI Releases Open-Weight Models</span>
                                <span class="text-xs text-gray-500">Aug 5, 2025</span>
                            </div>
                            <p class="text-sm text-gray-400 mt-1">gpt-oss-120b and gpt-oss-20b — only 2 of 39 OpenAI models are open-weight. A rare move toward open-source from OpenAI.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- GPT-5.6 Latest Flagship -->
        <div class="bg-gray-800 rounded-2xl shadow-2xl p-8 md:p-10 mb-8">
            <h2 class="text-2xl font-bold text-white border-b border-gray-700 pb-3 mb-6">
                <i class="fas fa-bolt text-lime-500 mr-2"></i>GPT-5.6 — The Latest Frontier (June 2026)
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gray-900/50 rounded-xl p-5 border border-gray-700">
                    <h3 class="text-lg font-bold text-lime-400">GPT-5.6 Sol</h3>
                    <p class="text-sm text-gray-300 mt-2">Frontier model for complex professional work. OpenAI's most capable model for demanding tasks across industries.</p>
                    <span class="inline-block mt-3 px-3 py-1 bg-lime-500/10 text-lime-400 text-xs rounded-full border border-lime-500/30">Newest</span>
                </div>
                <div class="bg-gray-900/50 rounded-xl p-5 border border-gray-700">
                    <h3 class="text-lg font-bold text-blue-400">GPT-5.6 Terra</h3>
                    <p class="text-sm text-gray-300 mt-2">Balances intelligence and cost. Best scores on BullshitBench v2 (53%) — excels at factual accuracy.</p>
                    <span class="inline-block mt-3 px-3 py-1 bg-blue-500/10 text-blue-400 text-xs rounded-full border border-blue-500/30">Best Value</span>
                </div>
                <div class="bg-gray-900/50 rounded-xl p-5 border border-gray-700">
                    <h3 class="text-lg font-bold text-purple-400">GPT-5.6 Luna</h3>
                    <p class="text-sm text-gray-300 mt-2">Optimized for cost-sensitive workloads. High performance at a fraction of the cost for high-volume applications.</p>
                    <span class="inline-block mt-3 px-3 py-1 bg-purple-500/10 text-purple-400 text-xs rounded-full border border-purple-500/30">Budget-Friendly</span>
                </div>
            </div>
        </div>

        <!-- GPT-5 Family Timeline -->
        <div class="bg-gray-800 rounded-2xl shadow-2xl p-8 md:p-10 mb-8">
            <h2 class="text-2xl font-bold text-white border-b border-gray-700 pb-3 mb-6">
                <i class="fas fa-timeline text-lime-500 mr-2"></i>The GPT-5 Family — Model Evolution
            </h2>
            <div class="space-y-4">
                <div class="flex items-start gap-4">
                    <div class="w-3 h-3 mt-1.5 bg-lime-500 rounded-full shrink-0"></div>
                    <div>
                        <div class="flex items-center gap-3 flex-wrap">
                            <span class="text-white font-semibold">GPT-5.6 Sol / Terra / Luna</span>
                            <span class="text-xs text-gray-500">Jun 2026</span>
                        </div>
                        <p class="text-sm text-gray-400 mt-1">Latest frontier series — three tiers for different use cases. Terra holds the best factual accuracy benchmark to date.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="w-3 h-3 mt-1.5 bg-blue-500 rounded-full shrink-0"></div>
                    <div>
                        <div class="flex items-center gap-3 flex-wrap">
                            <span class="text-white font-semibold">GPT-5.5 / GPT-5.5-Pro</span>
                            <span class="text-xs text-gray-500">Apr 2026</span>
                        </div>
                        <p class="text-sm text-gray-400 mt-1">"A new class of intelligence." SWE-Bench Pro: 58.6%. Humanity's Last Exam: 41.4%. ARC-AGI-2: 84.6%. OSWorld-Verified: 78.7%.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="w-3 h-3 mt-1.5 bg-green-500 rounded-full shrink-0"></div>
                    <div>
                        <div class="flex items-center gap-3 flex-wrap">
                            <span class="text-white font-semibold">GPT-5.4 / GPT-5.4-Pro</span>
                            <span class="text-xs text-gray-500">Mar 2026</span>
                        </div>
                        <p class="text-sm text-gray-400 mt-1">Integrated coding from GPT-5.3-Codex. Improved agentic workflows. "Thinking" mode shows plan before responding. Mid-response course correction.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="w-3 h-3 mt-1.5 bg-yellow-500 rounded-full shrink-0"></div>
                    <div>
                        <div class="flex items-center gap-3 flex-wrap">
                            <span class="text-white font-semibold">GPT-5.3-Codex / GPT-5.3-Codex-Spark</span>
                            <span class="text-xs text-gray-500">Feb 2026</span>
                        </div>
                        <p class="text-sm text-gray-400 mt-1">Specialized coding models with dynamic thinking. Designed for autonomous software engineering tasks.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="w-3 h-3 mt-1.5 bg-orange-500 rounded-full shrink-0"></div>
                    <div>
                        <div class="flex items-center gap-3 flex-wrap">
                            <span class="text-white font-semibold">GPT-5 / GPT-5 Pro / GPT-5 mini / GPT-5 nano</span>
                            <span class="text-xs text-gray-500">Aug 2025</span>
                        </div>
                        <p class="text-sm text-gray-400 mt-1">The original unified system — smart routing across model variants. 94.6% on AIME 2025. 74.9% SWE-bench. 45% fewer hallucinations than GPT-4o. Free for all users.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="w-3 h-3 mt-1.5 bg-gray-500 rounded-full shrink-0"></div>
                    <div>
                        <div class="flex items-center gap-3 flex-wrap">
                            <span class="text-white font-semibold">GPT-4.1 / GPT-4.1 mini / GPT-4.1 nano</span>
                            <span class="text-xs text-gray-500">Apr 2025</span>
                        </div>
                        <p class="text-sm text-gray-400 mt-1">Bridge generation before GPT-5. Improved instruction following and long-context performance.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reasoning Models -->
        <div class="bg-gray-800 rounded-2xl shadow-2xl p-8 md:p-10 mb-8">
            <h2 class="text-2xl font-bold text-white border-b border-gray-700 pb-3 mb-6">
                <i class="fas fa-brain text-lime-500 mr-2"></i>Reasoning Models — The o-Series
            </h2>
            <p class="text-sm text-gray-300 mb-6">OpenAI's o-series models devote additional deliberation time for step-by-step logical reasoning. This "System 2" approach enables solving complex problems that standard models cannot.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-900/50 rounded-xl p-5 border border-gray-700">
                    <h3 class="font-bold text-white">o3</h3>
                    <p class="text-xs text-gray-500 mb-2">Released Apr 2025</p>
                    <p class="text-sm text-gray-300">Advanced reasoning model. Three effort levels: low, medium, high. Powers ChatGPT Deep Research. Successor to o1, predecessor absorbed into GPT-5.</p>
                </div>
                <div class="bg-gray-900/50 rounded-xl p-5 border border-gray-700">
                    <h3 class="font-bold text-white">o4-mini</h3>
                    <p class="text-xs text-gray-500 mb-2">Released Apr 2025</p>
                    <p class="text-sm text-gray-300">Cost-efficient reasoning for high-volume applications. Balances reasoning depth with speed and affordability.</p>
                </div>
                <div class="bg-gray-900/50 rounded-xl p-5 border border-gray-700">
                    <h3 class="font-bold text-white">o3-pro</h3>
                    <p class="text-xs text-gray-500 mb-2">Released Jun 2025</p>
                    <p class="text-sm text-gray-300">Enhanced o3 variant for the most demanding reasoning tasks. Available to Pro-tier subscribers.</p>
                </div>
                <div class="bg-gray-900/50 rounded-xl p-5 border border-gray-700">
                    <h3 class="font-bold text-white">o3-mini / o3-mini-high</h3>
                    <p class="text-xs text-gray-500 mb-2">Released Jan 2025</p>
                    <p class="text-sm text-gray-300">Specialized alternative for technical domains requiring precision and speed. Free users get medium reasoning; paid users get high.</p>
                </div>
            </div>
        </div>

        <!-- Benchmark Comparison -->
        <div class="bg-gray-800 rounded-2xl shadow-2xl p-8 md:p-10 mb-8">
            <h2 class="text-2xl font-bold text-white border-b border-gray-700 pb-3 mb-6">
                <i class="fas fa-chart-bar text-lime-500 mr-2"></i>Benchmark Performance
            </h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-700">
                            <th class="text-left py-3 text-gray-400 font-medium">Benchmark</th>
                            <th class="text-right py-3 text-lime-400 font-medium">GPT-5 / 5.5</th>
                            <th class="text-right py-3 text-blue-400 font-medium">Claude Opus 4.1</th>
                            <th class="text-right py-3 text-purple-400 font-medium">Gemini 2.5 Pro</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-300">
                        <tr class="border-b border-gray-700/50">
                            <td class="py-3">AIME 2025 (Math)</td>
                            <td class="text-right py-3 text-lime-400">94.6%</td>
                            <td class="text-right py-3">—</td>
                            <td class="text-right py-3">—</td>
                        </tr>
                        <tr class="border-b border-gray-700/50">
                            <td class="py-3">GPQA Diamond (Science)</td>
                            <td class="text-right py-3 text-lime-400">89.4%</td>
                            <td class="text-right py-3">87.3%</td>
                            <td class="text-right py-3">86.6%</td>
                        </tr>
                        <tr class="border-b border-gray-700/50">
                            <td class="py-3">SWE-bench Verified (Coding)</td>
                            <td class="text-right py-3 text-lime-400">74.9%</td>
                            <td class="text-right py-3">74.4%</td>
                            <td class="text-right py-3">72.8%</td>
                        </tr>
                        <tr class="border-b border-gray-700/50">
                            <td class="py-3">SWE-bench Pro</td>
                            <td class="text-right py-3 text-lime-400">58.6% (GPT-5.5)</td>
                            <td class="text-right py-3">—</td>
                            <td class="text-right py-3">—</td>
                        </tr>
                        <tr class="border-b border-gray-700/50">
                            <td class="py-3">Humanity's Last Exam</td>
                            <td class="text-right py-3 text-lime-400">41.4% (GPT-5.5)</td>
                            <td class="text-right py-3">—</td>
                            <td class="text-right py-3">—</td>
                        </tr>
                        <tr class="border-b border-gray-700/50">
                            <td class="py-3">ARC-AGI-2</td>
                            <td class="text-right py-3 text-lime-400">84.6% (GPT-5.5)</td>
                            <td class="text-right py-3">—</td>
                            <td class="text-right py-3">—</td>
                        </tr>
                        <tr class="border-b border-gray-700/50">
                            <td class="py-3">OSWorld-Verified</td>
                            <td class="text-right py-3 text-lime-400">78.7% (GPT-5.5)</td>
                            <td class="text-right py-3">—</td>
                            <td class="text-right py-3">—</td>
                        </tr>
                        <tr>
                            <td class="py-3">MMMU (Multimodal)</td>
                            <td class="text-right py-3 text-lime-400">84.2%</td>
                            <td class="text-right py-3">—</td>
                            <td class="text-right py-3">—</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Key Breakthroughs -->
        <div class="bg-gray-800 rounded-2xl shadow-2xl p-8 md:p-10 mb-8">
            <h2 class="text-2xl font-bold text-white border-b border-gray-700 pb-3 mb-6">
                <i class="fas fa-rocket text-lime-500 mr-2"></i>Key Breakthroughs in 2025-2026
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex gap-4">
                    <div class="w-10 h-10 bg-lime-500/10 rounded-lg flex items-center justify-center shrink-0">
                        <i class="fas fa-shield-halved text-lime-500"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-white text-sm">Hallucination Reduction</h3>
                        <p class="text-sm text-gray-400 mt-1">GPT-5 produces 45% fewer errors than GPT-4o with web search. In thinking mode, 80% fewer than o3. Medical hallucination rate is 7x lower than GPT-4o.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-10 h-10 bg-blue-500/10 rounded-lg flex items-center justify-center shrink-0">
                        <i class="fas fa-route text-blue-500"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-white text-sm">Unified Smart Routing</h3>
                        <p class="text-sm text-gray-400 mt-1">GPT-5 automatically routes queries between model variants — instant replies for greetings, deep reasoning for complex problems. No manual model switching needed.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-10 h-10 bg-purple-500/10 rounded-lg flex items-center justify-center shrink-0">
                        <i class="fas fa-code text-purple-500"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-white text-sm">Coding Supremacy</h3>
                        <p class="text-sm text-gray-400 mt-1">SWE-bench Verified: 74.9%. Aider Polyglot: 88%. GPT-5.3-Codex and GPT-5.4 integrate specialized coding with reasoning for autonomous software engineering.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-10 h-10 bg-yellow-500/10 rounded-lg flex items-center justify-center shrink-0">
                        <i class="fas fa-comment-dots text-yellow-500"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-white text-sm">Reduced Sycophancy</h3>
                        <p class="text-sm text-gray-400 mt-1">Sycophantic replies dropped from 14.5% to under 6%. Models now provide honest, direct answers rather than always agreeing with users.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-10 h-10 bg-green-500/10 rounded-lg flex items-center justify-center shrink-0">
                        <i class="fas fa-lock text-green-500"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-white text-sm">Safe Completions</h3>
                        <p class="text-sm text-gray-400 mt-1">Instead of outright refusing sensitive requests, GPT-5 provides the most helpful answer within safety limits, with explanations when it cannot help.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-10 h-10 bg-red-500/10 rounded-lg flex items-center justify-center shrink-0">
                        <i class="fas fa-users text-red-500"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-white text-sm">Extended Thinking Controls</h3>
                        <p class="text-sm text-gray-400 mt-1">GPT-5.4 Thinking shows its plan upfront, allowing mid-response course correction. Adjusts thinking depth dynamically based on task complexity.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- OpenAI Ecosystem -->
        <div class="bg-gray-800 rounded-2xl shadow-2xl p-8 md:p-10 mb-8">
            <h2 class="text-2xl font-bold text-white border-b border-gray-700 pb-3 mb-6">
                <i class="fas fa-cubes text-lime-500 mr-2"></i>The OpenAI Ecosystem
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <h3 class="font-bold text-lime-400 mb-3 text-sm uppercase tracking-wider">Chat Products</h3>
                    <ul class="text-sm text-gray-300 space-y-2">
                        <li class="flex items-center gap-2"><i class="fas fa-check text-lime-500 text-xs"></i> ChatGPT (Free, Plus, Pro, Team, Enterprise)</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check text-lime-500 text-xs"></i> Deep Research</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check text-lime-500 text-xs"></i> Custom GPTs & GPT Store</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check text-lime-500 text-xs"></i> ChatGPT Search</li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-blue-400 mb-3 text-sm uppercase tracking-wider">API Models</h3>
                    <ul class="text-sm text-gray-300 space-y-2">
                        <li class="flex items-center gap-2"><i class="fas fa-check text-blue-500 text-xs"></i> GPT-5.6 / 5.5 / 5.4 Series</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check text-blue-500 text-xs"></i> GPT-Image-2 (Image Generation)</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check text-blue-500 text-xs"></i> GPT-Realtime-2.1 (Voice/Audio)</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check text-blue-500 text-xs"></i> Whisper / TTS Models</li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-purple-400 mb-3 text-sm uppercase tracking-wider">Creative Tools</h3>
                    <ul class="text-sm text-gray-300 space-y-2">
                        <li class="flex items-center gap-2"><i class="fas fa-check text-purple-500 text-xs"></i> DALL-E 3 (Image Generation)</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check text-purple-500 text-xs"></i> Sora (Video Generation)</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check text-purple-500 text-xs"></i> Codex (Code Agent)</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check text-purple-500 text-xs"></i> GPT-5-Codex (Coding Model)</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Reasoning Techniques -->
        <div class="bg-gray-800 rounded-2xl shadow-2xl p-8 md:p-10 mb-8">
            <h2 class="text-2xl font-bold text-white border-b border-gray-700 pb-3 mb-6">
                <i class="fas fa-flask text-lime-500 mr-2"></i>How Reasoning Works — Key Techniques
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-900/50 rounded-xl p-5 border border-gray-700">
                    <h3 class="font-bold text-white text-sm">Chain-of-Thought (CoT)</h3>
                    <p class="text-sm text-gray-400 mt-2">Models break problems into intermediate steps before arriving at an answer. The o-series models use this natively with reinforcement learning to improve step quality.</p>
                </div>
                <div class="bg-gray-900/50 rounded-xl p-5 border border-gray-700">
                    <h3 class="font-bold text-white text-sm">Tree-of-Thoughts</h3>
                    <p class="text-sm text-gray-400 mt-2">Explores multiple reasoning branches simultaneously, evaluating and pruning paths. Used in o3 and GPT-5's deep thinking modes for complex multi-step problems.</p>
                </div>
                <div class="bg-gray-900/50 rounded-xl p-5 border border-gray-700">
                    <h3 class="font-bold text-white text-sm">RLHF / GRPO / DPO</h3>
                    <p class="text-sm text-gray-400 mt-2">Reinforcement Learning from Human Feedback and its variants. GRPO (Group Relative Policy Optimization) powers DeepSeek R1's open reasoning. DPO simplifies alignment.</p>
                </div>
                <div class="bg-gray-900/50 rounded-xl p-5 border border-gray-700">
                    <h3 class="font-bold text-white text-sm">Test-Time Compute</h3>
                    <p class="text-sm text-gray-400 mt-2">Dedicated compute at inference time for deliberation. This "slow AI" paradigm produces dramatically better results on hard problems at the cost of higher latency.</p>
                </div>
            </div>
        </div>

        <!-- Open Source & Competitors -->
        <div class="bg-gray-800 rounded-2xl shadow-2xl p-8 md:p-10 mb-8">
            <h2 class="text-2xl font-bold text-white border-b border-gray-700 pb-3 mb-6">
                <i class="fas fa-globe text-lime-500 mr-2"></i>The Broader AI Landscape
            </h2>
            <div class="space-y-4">
                <div class="flex gap-4">
                    <div class="w-10 h-10 bg-orange-500/10 rounded-lg flex items-center justify-center shrink-0">
                        <i class="fas fa-brain text-orange-500"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-white text-sm">gpt-oss-120b & gpt-oss-20b (Aug 2025)</h3>
                        <p class="text-sm text-gray-400 mt-1">OpenAI's rare open-weight models. Only 2 of 39 tracked OpenAI models are open-source/open-weight — the rest remain proprietary.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-10 h-10 bg-blue-500/10 rounded-lg flex items-center justify-center shrink-0">
                        <i class="fas fa-fire text-blue-500"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-white text-sm">DeepSeek R1</h3>
                        <p class="text-sm text-gray-400 mt-1">Open-weight reasoning model that challenged OpenAI's o3. Uses GRPO for self-training. Spurred OpenAI to increase o3-mini transparency.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-10 h-10 bg-green-500/10 rounded-lg flex items-center justify-center shrink-0">
                        <i class="fas fa-mountain text-green-500"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-white text-sm">Claude 4.x (Anthropic)</h3>
                        <p class="text-sm text-gray-400 mt-1">Extended thinking, agentic coding, and safety-focused design. Claude Opus 4.1 is competitive with GPT-5 on coding (74.4% SWE-bench) and science benchmarks.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-10 h-10 bg-red-500/10 rounded-lg flex items-center justify-center shrink-0">
                        <i class="fas fa-gem text-red-500"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-white text-sm">Gemini 2.5 Pro (Google)</h3>
                        <p class="text-sm text-gray-400 mt-1">Google's reasoning model with thinking mode. Strong on multimodal tasks and large context windows. 86.6% GPQA Diamond, 72.8% SWE-bench.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- The Road Ahead -->
        <div class="bg-gray-800 rounded-2xl shadow-2xl p-8 md:p-10 mb-8">
            <h2 class="text-2xl font-bold text-white border-b border-gray-700 pb-3 mb-6">
                <i class="fas fa-compass text-lime-500 mr-2"></i>The Road Ahead
            </h2>
            <div class="space-y-4 text-sm text-gray-300">
                <p>OpenAI releases a new model approximately every <span class="text-lime-400 font-semibold">39 days</span>. The next release is projected around <span class="text-white font-semibold">August 4, 2026</span>. The industry is converging on several key trends:</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                    <div class="bg-gray-900/50 rounded-xl p-4 border border-gray-700">
                        <h3 class="font-bold text-lime-400 text-sm">Unified Intelligence</h3>
                        <p class="text-xs text-gray-400 mt-2">Single models that handle both quick questions and deep reasoning. No more model pickers — AI determines the effort needed per query.</p>
                    </div>
                    <div class="bg-gray-900/50 rounded-xl p-4 border border-gray-700">
                        <h3 class="font-bold text-blue-400 text-sm">Autonomous Agents</h3>
                        <p class="text-xs text-gray-400 mt-2">Long-horizon planning, multi-day research, supply chain management — AI systems operating independently with human oversight.</p>
                    </div>
                    <div class="bg-gray-900/50 rounded-xl p-4 border border-gray-700">
                        <h3 class="font-bold text-purple-400 text-sm">Embodied AI</h3>
                        <p class="text-xs text-gray-400 mt-2">Reasoning models moving into robotics and physical systems. Real-world problem solving beyond text and code.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Bar -->
        <div class="bg-gradient-to-r from-lime-500/10 via-gray-800 to-lime-500/10 rounded-2xl shadow-2xl p-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div>
                    <p class="text-3xl font-bold text-lime-400">39</p>
                    <p class="text-xs text-gray-400 mt-1">OpenAI Models Tracked</p>
                </div>
                <div>
                    <p class="text-3xl font-bold text-blue-400">~39</p>
                    <p class="text-xs text-gray-400 mt-1">Days Between Releases</p>
                </div>
                <div>
                    <p class="text-3xl font-bold text-purple-400">5.6</p>
                    <p class="text-xs text-gray-400 mt-1">Latest GPT Version</p>
                </div>
                <div>
                    <p class="text-3xl font-bold text-yellow-400">84.6%</p>
                    <p class="text-xs text-gray-400 mt-1">ARC-AGI-2 Best Score</p>
                </div>
            </div>
        </div>

    </div>
</section>

<?= view('layout/footer') ?>
