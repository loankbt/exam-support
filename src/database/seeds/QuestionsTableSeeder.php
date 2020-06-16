<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
            // mcq for English (id: 1)
            [
                'content' => "She ______ French words for hours, but she still doesn't remember all of them",
                'subject_id' => 1
            ],
            [
                'content' => 'The boy waved his hands to his mother, who was standing at the school gate, to ______ her attention',
                'subject_id' => 1
            ],
            [
                'content' => 'He is one of the most ______ bosses I have ever worked with. He behaves rudely to not only me but also others in the staff',
                'subject_id' => 1
            ],
            [
                'content' => 'If a boss wants to have a well-qualified staff, he should have to pay his employees ______',
                'subject_id' => 1
            ],
            [
                'content' => "I'm very happy ______ in India. I really miss being there.",
                'subject_id' => 1
            ],
            [
                'content' => "They didn't reach an agreement _______ their differences.",
                'subject_id' => 1
            ],
            [
                'content' => "I wish I _____ those words. But now it's too late.",
                'subject_id' => 1
            ],
            [
                'content' => "The woman, who has been missing for 10 days, is believed _____.",
                'subject_id' => 1
            ],
            [
                'content' => "She was working on her computer with her baby next to _____.",
                'subject_id' => 1
            ],
            [
                'content' => "_____ to offend anyone, she said both cakes were equally good.",
                'subject_id' => 1
            ],
            // saq for Literature (id: 2)
            [
                'content' => "An American film actor once said, “Tomorrow is important and precious”. Some
                people think individuals and society should pay more attention to the future than
                to the present. Do you agree or disagree?",
                'subject_id' => 2
            ],
            [
                'content' => "Scientists and the news media are presenting ever more evidence of climate
                change.
                Governments cannot be expected to solve this problem. It is the responsibility of
                individuals to change their lifestyle to prevent further damage.
                What are your views?",
                'subject_id' => 2
            ],
            [
                'content' => "Popular events like the football world cup and other international sporting
                occasions are essential in easing international tensions and releasing patriotic
                emotions in a safe way.
                To what extent do you agree or disagree with this opinion?",
                'subject_id' => 2
            ],
            [
                'content' => "Some people say that the Internet is making the world smaller by bringing people
                together. To what extent do you agree that the internet is making it easier for
                people to communicate with one another?",
                'subject_id' => 2
            ],
            [
                'content' => "Wild animals have no place in the 21st century, and the protection is a waste of
                resources. To what extent do you agree or disagree?",
                'subject_id' => 2
            ],
            // mcq for Chemistry (id: 3)
            [
                'content' => 'In which family is an element in Group 16, Period 4 found?',
                'subject_id' => 3
            ],
            [
                'content' => 'Which molecule serves as the main food source for most known cells?',
                'subject_id' => 3
            ],
            [
                'content' => 'In chemistry, we describe a mixture as',
                'subject_id' => 3
            ],
            [
                'content' => 'In chemistry, we describe an atom as',
                'subject_id' => 3
            ],
            [
                'content' => '______ is the measure of the quantity of matter.',
                'subject_id' => 3
            ],
            [
                'content' => 'If there are two elements with the same atomic number and a different number of neutrons, it is called a(n) ______.',
                'subject_id' => 3
            ],
            [
                'content' => 'Which of the following terms describes a change that produces matter with a different composition than that of the original matter?',
                'subject_id' => 3
            ],
            [
                'content' => 'You know that you have a balanced chemical equation when the',
                'subject_id' => 3
            ],
            [
                'content' => 'What is the atomic number of an ion with 5 protons, 6 neutrons, and a charge of 3+?',
                'subject_id' => 3
            ],
            [
                'content' => 'Each row of the periodic table is called a',
                'subject_id' => 3
            ],
        ]);
    }
}
