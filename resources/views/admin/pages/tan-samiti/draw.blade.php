@extends("admin.layouts.master")

@section("title", "Lottery Draw — " . $tanSamiti->name)

@push('styles')
<style>
    .draw-stage {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        border-radius: 16px;
        padding: 40px 20px;
        text-align: center;
        color: #fff;
        position: relative;
        overflow: hidden;
    }
    .draw-stage::before {
        content: '';
        position: absolute;
        top: -50%; left: -50%;
        width: 200%; height: 200%;
        background: radial-gradient(circle, rgba(255,215,0,0.05) 0%, transparent 70%);
        animation: rotate 8s linear infinite;
    }
    @keyframes rotate {
        from { transform: rotate(0deg); }
        to   { transform: rotate(360deg); }
    }
    .spinner-box {
        background: rgba(255,255,255,0.07);
        border: 2px solid rgba(255,215,0,0.4);
        border-radius: 12px;
        padding: 30px 20px;
        margin: 20px auto;
        max-width: 380px;
        min-height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        z-index: 1;
    }
    .spinner-name {
        font-size: 1.8rem;
        font-weight: 700;
        color: #ffd700;
        letter-spacing: 1px;
        transition: opacity 0.1s;
    }
    .spinner-name.idle {
        color: rgba(255,255,255,0.4);
        font-size: 1rem;
        font-weight: 400;
    }
    .winner-reveal {
        display: none;
        animation: winnerPop 0.5s ease-out;
    }
    @keyframes winnerPop {
        0%   { transform: scale(0.5); opacity: 0; }
        70%  { transform: scale(1.1); }
        100% { transform: scale(1);   opacity: 1; }
    }
    .winner-avatar {
        width: 80px; height: 80px;
        border-radius: 50%;
        border: 3px solid #ffd700;
        object-fit: cover;
        margin-bottom: 10px;
    }
    .btn-spin {
        background: linear-gradient(135deg, #ffd700, #ff8c00);
        border: none;
        color: #1a1a2e;
        font-weight: 700;
        font-size: 1.1rem;
        padding: 14px 40px;
        border-radius: 50px;
        cursor: pointer;
        transition: transform 0.1s, box-shadow 0.2s;
        position: relative;
        z-index: 1;
    }
    .btn-spin:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(255,215,0,0.4); }
    .btn-spin:disabled { opacity: 0.5; cursor: not-allowed; transform: none; box-shadow: none; }

    .confetti-piece {
        position: absolute;
        width: 10px; height: 10px;
        border-radius: 2px;
        animation: confettiFall 1.5s ease-in forwards;
        pointer-events: none;
    }
    @keyframes confettiFall {
        0%   { transform: translateY(-20px) rotate(0deg); opacity: 1; }
        100% { transform: translateY(300px) rotate(720deg); opacity: 0; }
    }
    .cycle-badge {
        display: inline-block;
        background: rgba(255,215,0,0.2);
        border: 1px solid rgba(255,215,0,0.5);
        color: #ffd700;
        padding: 4px 14px;
        border-radius: 20px;
        font-size: 0.85rem;
        margin-bottom: 10px;
    }
    .eligible-pill {
        display: inline-block;
        background: rgba(255,255,255,0.1);
        border-radius: 20px;
        padding: 3px 12px;
        margin: 3px;
        font-size: 0.8rem;
        color: rgba(255,255,255,0.8);
    }
</style>
@endpush

@section("content")

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
@endif

<div class="row">

    {{-- Spinner Panel --}}
    <div class="col-lg-7">
        <div class="card mb-0">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">
                    <i class="fas fa-random mr-2 text-warning"></i> Lottery Draw — {{ $tanSamiti->name }}
                </h3>
                <a href="{{ route('admin.tan-samiti.show', $tanSamiti) }}" class="btn btn-sm btn-secondary">
                    <i class="fas fa-arrow-left mr-1"></i> Back
                </a>
            </div>
            <div class="card-body">

                @if($eligible->isEmpty())
                    <div class="alert alert-success text-center">
                        <i class="fas fa-trophy fa-2x mb-2"></i><br>
                        <strong>All cycles complete!</strong> Every member has won once.
                    </div>
                @else

                <div class="draw-stage" id="drawStage">
                    <div class="cycle-badge" id="cycleBadge">
                        Draw #{{ $tanSamiti->nextCycleNumber() }}
                    </div>

                    <div class="spinner-box">
                        <div id="spinnerDisplay">
                            <div class="spinner-name idle" id="spinnerName">Press SPIN to start</div>
                        </div>
                    </div>

                    <div class="winner-reveal mb-3" id="winnerReveal">
                        <img src="" id="winnerPhoto" class="winner-avatar d-none"><br>
                        <div style="font-size:1rem; color:rgba(255,255,255,0.7);">🎉 Winner of Draw #<span id="winnerCycle"></span></div>
                        <div class="spinner-name mt-1" id="winnerName"></div>
                    </div>

                    <button class="btn-spin" id="btnSpin">
                        <i class="fas fa-random mr-2"></i> SPIN
                    </button>

                    <div class="mt-3" id="eligibleList">
                        <small style="opacity:.6">Eligible members ({{ $eligible->count() }}):</small><br>
                        @foreach($eligible as $m)
                            <span class="eligible-pill" data-user-id="{{ $m->user_id }}">{{ $m->user->name }}</span>
                        @endforeach
                    </div>
                </div>

                {{-- Hidden confirm form --}}
                <form id="confirmForm" action="{{ route('admin.tan-samiti.draw.confirm', $tanSamiti) }}" method="POST" class="mt-3" style="display:none">
                    @csrf
                    <input type="hidden" name="user_id" id="confirmUserId">
                    <input type="hidden" name="cycle_number" id="confirmCycle">
                    <div class="form-group">
                        <label>Note (optional)</label>
                        <input type="text" name="note" class="form-control" placeholder="e.g. May 2026 draw">
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success btn-lg flex-grow-1">
                            <i class="fas fa-check mr-2"></i> Confirm Winner
                        </button>
                        <button type="button" class="btn btn-secondary" id="btnReset">
                            <i class="fas fa-redo"></i> Re-spin
                        </button>
                    </div>
                </form>

                @endif

            </div>
        </div>
    </div>

    {{-- Draw History --}}
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-history mr-2"></i> Draw History
                    <span class="badge badge-secondary ml-1">{{ $draws->count() }} / {{ $tanSamiti->total_cycles }}</span>
                </h3>
            </div>
            <div class="card-body p-0" style="max-height:520px; overflow-y:auto">
                <table class="table table-sm mb-0">
                    <thead>
                        <tr>
                            <th>Cycle</th>
                            <th>Winner</th>
                            <th>Drawn On</th>
                            <th>By</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($draws->sortByDesc('cycle_number') as $draw)
                        <tr>
                            <td><span class="badge badge-warning">#{{ $draw->cycle_number }}</span></td>
                            <td>
                                <strong>{{ $draw->user->name }}</strong><br>
                                <small class="text-muted">{{ $draw->note }}</small>
                            </td>
                            <td><small>{{ $draw->drawn_at->format('d M Y, h:i A') }}</small></td>
                            <td><small>{{ $draw->drawnBy?->name ?? 'System' }}</small></td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-muted py-4">No draws yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
(function () {
    const spinUrl    = "{{ route('admin.tan-samiti.draw.spin', $tanSamiti) }}";
    const csrfToken  = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const btnSpin        = document.getElementById('btnSpin');
    const btnReset       = document.getElementById('btnReset');
    const spinnerName    = document.getElementById('spinnerName');
    const winnerReveal   = document.getElementById('winnerReveal');
    const winnerName     = document.getElementById('winnerName');
    const winnerPhoto    = document.getElementById('winnerPhoto');
    const winnerCycle    = document.getElementById('winnerCycle');
    const confirmForm    = document.getElementById('confirmForm');
    const confirmUserId  = document.getElementById('confirmUserId');
    const confirmCycle   = document.getElementById('confirmCycle');
    const eligiblePills  = Array.from(document.querySelectorAll('.eligible-pill'));

    if (!btnSpin) return; // no eligible members

    const eligibleNames = eligiblePills.map(p => p.textContent.trim());
    let spinInterval, winner;

    btnSpin.addEventListener('click', function () {
        btnSpin.disabled = true;
        winnerReveal.style.display = 'none';
        confirmForm.style.display  = 'none';
        spinnerName.classList.remove('idle');

        // Fetch winner from server
        fetch(spinUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            }
        })
        .then(r => r.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                btnSpin.disabled = false;
                return;
            }
            winner = data;
            runSpinner(data);
        })
        .catch(() => {
            alert('Network error. Try again.');
            btnSpin.disabled = false;
        });
    });

    function runSpinner(data) {
        let i = 0, speed = 60, elapsed = 0;
        const duration = 3500; // ms total spin

        spinInterval = setInterval(() => {
            elapsed += speed;
            spinnerName.textContent = eligibleNames[i % eligibleNames.length];
            i++;

            // Gradually slow down
            if (elapsed > duration * 0.6) speed = 150;
            if (elapsed > duration * 0.8) speed = 300;

            if (elapsed >= duration) {
                clearInterval(spinInterval);
                revealWinner(data);
            }
        }, speed);
    }

    function revealWinner(data) {
        spinnerName.textContent = '';
        winnerName.textContent  = data.winner_name;
        winnerCycle.textContent = data.cycle_number;

        if (data.winner_photo) {
            winnerPhoto.src = data.winner_photo;
            winnerPhoto.classList.remove('d-none');
        } else {
            winnerPhoto.classList.add('d-none');
        }

        winnerReveal.style.display = 'block';
        launchConfetti();

        // Set confirm form
        confirmUserId.value = data.winner_user_id;
        confirmCycle.value  = data.cycle_number;
        confirmForm.style.display = 'block';
    }

    if (btnReset) {
        btnReset.addEventListener('click', function () {
            winnerReveal.style.display = 'none';
            confirmForm.style.display  = 'none';
            spinnerName.className = 'spinner-name idle';
            spinnerName.textContent = 'Press SPIN to start';
            btnSpin.disabled = false;
        });
    }

    function launchConfetti() {
        const stage = document.getElementById('drawStage');
        const colors = ['#ffd700', '#ff6b6b', '#4ecdc4', '#45b7d1', '#96ceb4', '#ff9ff3'];
        for (let i = 0; i < 40; i++) {
            const piece = document.createElement('div');
            piece.className = 'confetti-piece';
            piece.style.cssText = `
                left: ${Math.random() * 100}%;
                top: 0;
                background: ${colors[Math.floor(Math.random() * colors.length)]};
                animation-delay: ${Math.random() * 0.5}s;
                animation-duration: ${1 + Math.random()}s;
                transform: rotate(${Math.random() * 360}deg);
            `;
            stage.appendChild(piece);
            setTimeout(() => piece.remove(), 2500);
        }
    }
})();
</script>
@endpush
