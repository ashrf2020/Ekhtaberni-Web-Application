<div>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>تنبيه!</strong> سيتم إلغاء الاختبار تلقائيًا في حالة إغلاق أو تحديث الصفحة.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="card card-statistics mb-30">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">{{ $data[$counter]->title }}</h5>
                <span class="badge badge-primary">سؤال {{ $counter + 1 }} من {{ count($data) }}</span>
                <span id="timer" class="badge badge-danger"></span>
            </div>
        </div>
        <div class="card-body">
            @foreach(preg_split('/(-)/', $data[$counter]->answers) as $index => $answer)
                @if(trim($answer) !== '')
                <div class="custom-control custom-radio mb-2">
                    <input 
                        type="radio" 
                        class="custom-control-input" 
                        name="question_{{ $data[$counter]->id }}" 
                        id="question_{{ $data[$counter]->id }}_{{ $index }}" 
                        value="{{ trim($answer) }}" 
                        wire:model="selectedAnswer"
                        required
                    >
                    <label class="custom-control-label" for="question_{{ $data[$counter]->id }}_{{ $index }}">
                        {{ trim($answer) }}
                    </label>
                </div>
                @endif
            @endforeach
        </div>
    </div>

    <!-- زر التالي -->
    <button type="button" 
            class="btn btn-primary mt-3" 
            wire:click="nextQuestion({{ $data[$counter]->id }}, {{ $data[$counter]->score }}, {{ json_encode($data[$counter]->right_answer) }})">التالي
    </button>
</div>

@push('scripts')
<script>
    // Set the exam duration in minutes (e.g., 60 minutes)
    const examDurationMinutes = 15;
    let timeInSeconds = examDurationMinutes * 60;

    // Get the timer element
    const timerElement = document.getElementById('timer');

    // Update the timer every second
    const timerInterval = setInterval(() => {
        const minutes = Math.floor(timeInSeconds / 60);
        const seconds = timeInSeconds % 60;

        // Format the time to always show two digits (e.g., 05:03)
        const formattedMinutes = String(minutes).padStart(2, '0');
        const formattedSeconds = String(seconds).padStart(2, '0');

        timerElement.textContent = `${formattedMinutes}:${formattedSeconds}`;

        if (timeInSeconds <= 0) {
            // Stop the timer
            clearInterval(timerInterval);
            timerElement.textContent = "انتهى الوقت";
            
            // Trigger an action when the time is up, like submitting the exam
            // You can use a Livewire method call to submit the form
            // e.g., @this.call('submitExam');
            // Or you can automatically click the submit button
            // document.getElementById('submitButton').click();
            // In your case, you can use:
            // @this.call('finishExam'); 
        }

        timeInSeconds--;
    }, 1000);

    // Prevent page reload/close during exam
    window.addEventListener('beforeunload', function (e) {
        // Show warning message
        e.preventDefault();
        e.returnValue = 'سيتم إلغاء الاختبار في حالة إغلاق الصفحة. هل أنت متأكد؟';
        return e.returnValue;
    });

    // Handle back/forward browser buttons
    window.addEventListener('popstate', function(e) {
        window.history.pushState(null, null, window.location.pathname);
    });

    // Prevent right-click context menu
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
        return false;
    });

    // Disable keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Allow only navigation keys and form controls
        const allowedKeys = [
            8,  // Backspace
            9,  // Tab
            13, // Enter
            16, // Shift
            17, // Ctrl
            18, // Alt
            19, // Pause/Break
            20, // Caps Lock
            27, // Escape
            33, // Page Up
            34, // Page Down
            35, // End
            36, // Home
            37, // Left Arrow
            38, // Up Arrow
            39, // Right Arrow
            40, // Down Arrow
            45, // Insert
            46, // Delete
            91, // Left Window Key
            92, // Right Window Key
            93, // Select Key
            112, // F1
            113, // F2
            114, // F3
            115, // F4
            116, // F5
            117, // F6
            118, // F7
            119, // F8
            120, // F9
            121, // F10
            122, // F11
            123, // F12
            144 // Num Lock
        ];

        // Allow form controls to work
        const tagName = e.target.tagName.toLowerCase();
        if (tagName === 'input' || tagName === 'textarea' || tagName === 'select' || tagName === 'button') {
            return true;
        }

        // Block function keys and other shortcuts
        if ((e.ctrlKey || e.altKey || e.metaKey) || 
            (e.keyCode >= 112 && e.keyCode <= 123) || // F1-F12
            (e.keyCode >= 37 && e.keyCode <= 40) || // Arrow keys
            e.keyCode === 8 || e.keyCode === 116) { // Backspace, F5
            
            e.preventDefault();
            e.stopPropagation();
            return false;
        }
    }, true);

    // Initialize Livewire event listeners
    document.addEventListener('livewire:init', () => {
        @this.on('redirect', (event) => {
            // Remove the beforeunload event when redirecting
            window.removeEventListener('beforeunload', window.beforeunload);
            window.location.href = event.url;
        });
    });
</script>
@endpush