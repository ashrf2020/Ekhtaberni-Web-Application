<?php

namespace App\Livewire;

use App\Models\Degree;
use App\Models\Question;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class ShowQuestion extends Component
{
    public $quizze_id, $student_id;
    public $data, $counter = 0, $questioncount;
    public $selectedAnswer; // نخزن إجابة الطالب هنا
    public $examStarted = false;
    public $examEnded = false;

    public function mount()
    {
        // Check if exam was already started
        $examSession = Session::get('exam_in_progress_' . $this->quizze_id . '_' . $this->student_id);
        
        if ($examSession && isset($examSession['started_at'])) {
            // If exam was already started, mark as abuse
            $this->markExamAsAbused();
            $this->examEnded = true;
            return;
        }
        
        // Mark exam as started
        Session::put('exam_in_progress_' . $this->quizze_id . '_' . $this->student_id, [
            'started_at' => now(),
            'quizze_id' => $this->quizze_id,
            'student_id' => $this->student_id
        ]);
        
        $this->examStarted = true;
    }

    public function render()
    {
        if ($this->examEnded) {
            return view('livewire.exam-abused');
        }
        
        $this->data = Question::where('quizze_id', $this->quizze_id)->get();
        $this->questioncount = $this->data->count();
        
        return view('livewire.show-question', [
            'data' => $this->data,
            'examStarted' => $this->examStarted
        ]);
    }
    
    protected function markExamAsAbused()
    {
        $degree = Degree::where('student_id', $this->student_id)
            ->where('quizze_id', $this->quizze_id)
            ->first();
            
        if ($degree) {
            $degree->abuse = '1';
            $degree->save();
        } else {
            $degree = new Degree();
            $degree->student_id = $this->student_id;
            $degree->quizze_id = $this->quizze_id;
            $degree->question_id = 0; // No specific question
            $degree->score = 0;
            $degree->abuse = '1';
            $degree->date = now();
            $degree->save();
        }
        
        // Clear the exam session
        Session::forget('exam_in_progress_' . $this->quizze_id . '_' . $this->student_id);
    }

    public function nextQuestion($question_id, $score, $right_answer)
    {
        try {
            // Validate input
            if (empty($this->selectedAnswer)) {
                $this->dispatch('alert', [
                    'type' => 'error',
                    'message' => 'الرجاء اختيار إجابة قبل المتابعة'
                ]);
                return false;
            }

            // Clean up the right answer from any HTML entities
            $right_answer = html_entity_decode($right_answer);
            $right_answer = trim($right_answer);
            
            // Clean up the selected answer
            $selectedAnswer = trim($this->selectedAnswer);

            $studDegree = Degree::where('student_id', $this->student_id)
                ->where('quizze_id', $this->quizze_id)
                ->first();

            if ($studDegree === null) {
                $degree = new Degree();
                $degree->student_id = $this->student_id;
                $degree->quizze_id = $this->quizze_id;
                $degree->question_id = $question_id;
                $degree->score = (strcasecmp($selectedAnswer, $right_answer) === 0) ? $score : 0;
                $degree->date = now();
                $degree->save();
            } else {
                // Check if this is a new question or a retake
                if ($studDegree->question_id == $question_id) {
                    $studDegree->abuse = '1';
                    $studDegree->save();
                    $this->dispatch('alert', [
                        'type' => 'error',
                        'message' => 'لا يمكنك الإجابة على هذا السؤال مرة أخرى'
                    ]);
                    return false;
                }
                
                // Update the score if the answer is correct
                if (strcasecmp($selectedAnswer, $right_answer) === 0) {
                    $studDegree->score += $score;
                }
                $studDegree->question_id = $question_id;
                $studDegree->save();
            }
        } catch (\Exception $e) {
            \Log::error('Error in nextQuestion: ' . $e->getMessage());
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'حدث خطأ أثناء محاولة حفظ إجابتك. يرجى المحاولة مرة أخرى.'
            ]);
            return false;
        }

        // انتقل للسؤال التالي أو انهي الامتحان
        if ($this->counter < $this->questioncount - 1) {
            $this->counter++;
            $this->selectedAnswer = null;
            $this->resetErrorBag();
        } else {
            // Clear the exam session
            Session::forget('exam_in_progress_' . $this->quizze_id . '_' . $this->student_id);
            
            // Store success message in session
            session()->flash('success', 'تم الانتهاء من الاختبار بنجاح');
            
            // Redirect to the student's exams page
            return redirect()->route('student.exams.index');
        }
    }
}
