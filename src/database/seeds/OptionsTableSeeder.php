<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('options')->insert([
            [
                'question_id' => '1',
                'content' => 'has been learning',
                'is_answer' => 1
            ],
            [
                'question_id' => '1',
                'content' => 'has been learnt',
                'is_answer' => 0
            ],
            [
                'question_id' => '1',
                'content' => 'has learnt',
                'is_answer' => 0
            ],
            [
                'question_id' => '1',
                'content' => 'have been learning',
                'is_answer' => 0
            ],

            [
                'question_id' => '2',
                'content' => 'attract',
                'is_answer' => 1
            ],
            [
                'question_id' => '2',
                'content' => 'pull',
                'is_answer' => 0
            ],
            [
                'question_id' => '2',
                'content' => 'follow',
                'is_answer' => 0
            ],
            [
                'question_id' => '2',
                'content' => 'tempt',
                'is_answer' => 0
            ],
            [
                'question_id' => '3',
                'content' => 'thoughtful',
                'is_answer' => 0
            ],
            [
                'question_id' => '3',
                'content' => 'impolite',
                'is_answer' => 1
            ],
            [
                'question_id' => '3',
                'content' => 'attentive',
                'is_answer' => 0
            ],
            [
                'question_id' => '3',
                'content' => 'communicative',
                'is_answer' => 0
            ],

            [
                'question_id' => '4',
                'content' => 'appropriate',
                'is_answer' => 0
            ],
            [
                'question_id' => '4',
                'content' => 'appropriately',
                'is_answer' => 1
            ],
            [
                'question_id' => '4',
                'content' => 'appropriation',
                'is_answer' => 0
            ],
            [
                'question_id' => '4',
                'content' => 'appropriating',
                'is_answer' => 0
            ],

            [
                'question_id' => '5',
                'content' => 'to live',
                'is_answer' => 1
            ],
            [
                'question_id' => '5',
                'content' => 'to have lived',
                'is_answer' => 0
            ],
            [
                'question_id' => '5',
                'content' => 'to be lived',
                'is_answer' => 0
            ],
            [
                'question_id' => '5',
                'content' => 'to be living',
                'is_answer' => 0
            ],
            [
                'question_id' => '6',
                'content' => 'on account of',
                'is_answer' => 1
            ],
            [
                'question_id' => '6',
                'content' => 'due',
                'is_answer' => 0
            ],
            [
                'question_id' => '6',
                'content' => 'because',
                'is_answer' => 0
            ],
            [
                'question_id' => '6',
                'content' => 'owing',
                'is_answer' => 0
            ],
            [
                'question_id' => '7',
                'content' => 'not having said',
                'is_answer' => 0
            ],
            [
                'question_id' => '7',
                'content' => 'have never said ',
                'is_answer' => 0
            ],
            [
                'question_id' => '7',
                'content' => 'never said ',
                'is_answer' => 0
            ],
            [
                'question_id' => '7',
                'content' => 'had never said',
                'is_answer' => 1
            ],
            [
                'question_id' => '8',
                'content' => 'to be abducted',
                'is_answer' => 1
            ],
            [
                'question_id' => '8',
                'content' => 'to be abducting',
                'is_answer' => 0
            ],
            [
                'question_id' => '8',
                'content' => 'to have been abducted',
                'is_answer' => 0
            ],
            [
                'question_id' => '8',
                'content' => 'to have been abducting',
                'is_answer' => 0
            ],
            [
                'question_id' => '9',
                'content' => 'herself',
                'is_answer' => 0
            ],
            [
                'question_id' => '9',
                'content' => 'her',
                'is_answer' => 1
            ],
            [
                'question_id' => '9',
                'content' => 'her own',
                'is_answer' => 0
            ],
            [
                'question_id' => '9',
                'content' => 'hers',
                'is_answer' => 0
            ],
            [
                'question_id' => '10',
                'content' => 'Not wanting',
                'is_answer' => 1
            ],
            [
                'question_id' => '10',
                'content' => 'As not wanting',
                'is_answer' => 0
            ],
            [
                'question_id' => '10',
                'content' => "She didn't want",
                'is_answer' => 0
            ],
            [
                'question_id' => '10',
                'content' => 'Because not wanting',
                'is_answer' => 0
            ],
            [
                'question_id' => '16',
                'content' => 'The Halogen Family',
                'is_answer' => 0
            ],
            [
                'question_id' => '16',
                'content' => 'The Oxygen Family',
                'is_answer' => 1
            ],
            [
                'question_id' => '16',
                'content' => 'The Nitrogen Family',
                'is_answer' => 0
            ],
            [
                'question_id' => '16',
                'content' => 'The Radon Family',
                'is_answer' => 0
            ],
            [
                'question_id' => '17',
                'content' => 'sucrose',
                'is_answer' => 0
            ],
            [
                'question_id' => '17',
                'content' => 'cellulose',
                'is_answer' => 1
            ],
            [
                'question_id' => '17',
                'content' => 'PGAL',
                'is_answer' => 0
            ],
            [
                'question_id' => '17',
                'content' => 'glucose',
                'is_answer' => 0
            ],
            [
                'question_id' => '18',
                'content' => 'a combination of pure substances formed through chemical bonding.',
                'is_answer' => 0
            ],
            [
                'question_id' => '18',
                'content' => 'any substance possessing a uniform composition throughout.',
                'is_answer' => 0
            ],
            [
                'question_id' => '18',
                'content' => 'a physical combination of two or more types of substances,with each maintaining its own characteristic properties.',
                'is_answer' => 1
            ],
            [
                'question_id' => '18',
                'content' => 'any collection of elements chemically bound to each other.',
                'is_answer' => 0
            ],
            [
                'question_id' => '19',
                'content' => 'the tiniest unit of matter that keeps its characteristic chemical identity.',
                'is_answer' => 1
            ],
            [
                'question_id' => '19',
                'content' => 'the simplest unit of a compound.',
                'is_answer' => 0
            ],
            [
                'question_id' => '19',
                'content' => 'always being made up of carbon.',
                'is_answer' => 0
            ],
            [
                'question_id' => '19',
                'content' => 'being smaller than an electron.',
                'is_answer' => 0
            ],
            [
                'question_id' => '20',
                'content' => 'Weight',
                'is_answer' => 0
            ],
            [
                'question_id' => '20',
                'content' => 'Mass',
                'is_answer' => 1
            ],
            [
                'question_id' => '20',
                'content' => 'Density',
                'is_answer' => 0
            ],
            [
                'question_id' => '20',
                'content' => 'Chemistry',
                'is_answer' => 0
            ],
            [
                'question_id' => '21',
                'content' => 'neuron',
                'is_answer' => 1
            ],
            [
                'question_id' => '21',
                'content' => 'isotope',
                'is_answer' => 0
            ],
            [
                'question_id' => '21',
                'content' => 'clone',
                'is_answer' => 0
            ],
            [
                'question_id' => '21',
                'content' => 'ion',
                'is_answer' => 0
            ],
            [
                'question_id' => '22',
                'content' => 'Physical property',
                'is_answer' => 0
            ],
            [
                'question_id' => '22',
                'content' => 'Chemical property',
                'is_answer' => 1
            ],
            [
                'question_id' => '22',
                'content' => 'Physical change',
                'is_answer' => 0
            ],
            [
                'question_id' => '22',
                'content' => 'Chemical change',
                'is_answer' => 0
            ],
            [
                'question_id' => '23',
                'content' => 'coefficients of the reactants equal the coefficients of the products.',
                'is_answer' => 0
            ],
            [
                'question_id' => '23',
                'content' => 'number of atoms of each element in the reactants equal that of each corresponding element in the products.',
                'is_answer' => 1
            ],
            [
                'question_id' => '23',
                'content' => 'products and reactants are the same chemicals.',
                'is_answer' => 0
            ],
            [
                'question_id' => '23',
                'content' => 'subscripts of the reactants equal the subscripts of the products.',
                'is_answer' => 0
            ],
            [
                'question_id' => '24',
                'content' => '5',
                'is_answer' => 1
            ],
            [
                'question_id' => '24',
                'content' => '11',
                'is_answer' => 0
            ],
            [
                'question_id' => '24',
                'content' => '6',
                'is_answer' => 0
            ],
            [
                'question_id' => '24',
                'content' => '4.5',
                'is_answer' => 0
            ],
            [
                'question_id' => '25',
                'content' => 'period.',
                'is_answer' => 0
            ],
            [
                'question_id' => '25',
                'content' => 'group',
                'is_answer' => 0
            ],
            [
                'question_id' => '25',
                'content' => 'product.',
                'is_answer' => 0
            ],
            [
                'question_id' => '25',
                'content' => 'reactant.',
                'is_answer' => 0
            ],
        ]);
    }
}
