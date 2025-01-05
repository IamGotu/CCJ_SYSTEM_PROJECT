<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ViolationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $violations = [
            // Minor offenses
            ['violation_type' => 'minor', 'violation_name' => 'Disregards established policies, rules and regulations & requirements', 'grounds' => 'includes attendance, uniform, and identification card'],
            ['violation_type' => 'minor', 'violation_name' => 'Unauthorized use of the name of the school/personnel', 'grounds' => ''],
            ['violation_type' => 'minor', 'violation_name' => 'Leaving the room and/or school campus during class hours', 'grounds' => 'without permission from the school personnel'],
            ['violation_type' => 'minor', 'violation_name' => 'Erasing, removing, mutilating, altering', 'grounds' => 'and/or posting announcement on bulletin boards without permission from the school authority'],
            ['violation_type' => 'minor', 'violation_name' => 'Refusal to attend official schools activity', 'grounds' => ''],
            ['violation_type' => 'minor', 'violation_name' => 'Fighting inside the campus or in any school initiated activity', 'grounds' => ''],
            ['violation_type' => 'minor', 'violation_name' => 'Unauthorized use of school room, quadrangle, electric current, equipment and materials;', 'grounds' => ''],
            ['violation_type' => 'minor', 'violation_name' => 'Making unnecessary noise or unnecessary action', 'grounds' => 'leading to the disruption of classes and/or stoppage of business operations'],
            ['violation_type' => 'minor', 'violation_name' => 'Smoking in the school premises and in any school initiated activity', 'grounds' => ''],
            ['violation_type' => 'minor', 'violation_name' => 'Refusal to submit and to meet security requirements of the school', 'grounds' => ''],
            ['violation_type' => 'minor', 'violation_name' => 'Littering', 'grounds' => ''],
            ['violation_type' => 'minor', 'violation_name' => 'Sleeping inside the classroom during class hours', 'grounds' => ''],
            
            // Major offenses
            ['violation_type' => 'major', 'violation_name' => 'Bullying', 'grounds' => ''],
            ['violation_type' => 'major', 'violation_name' => 'Cyber Bullying', 'grounds' => ''],
            ['violation_type' => 'major', 'violation_name' => 'Dishonesty', 'grounds' => ''],
            ['violation_type' => 'major', 'violation_name' => 'Hazing', 'grounds' => ''],
            ['violation_type' => 'major', 'violation_name' => 'Carrying a deadly weapon', 'grounds' => ''],
            ['violation_type' => 'major', 'violation_name' => 'Selling and/or possession of prohibited drugs', 'grounds' => ''],
            ['violation_type' => 'major', 'violation_name' => 'Under the influence of liquor', 'grounds' => ''],
            ['violation_type' => 'major', 'violation_name' => 'Vandalism', 'grounds' => ''],
            ['violation_type' => 'major', 'violation_name' => 'Assaulting a pupil or student or school personnel', 'grounds' => ''],
            ['violation_type' => 'major', 'violation_name' => 'Instigating or leading illegal strikes', 'grounds' => 'or similar concerted activities resulting in the stoppage of classes'],
            ['violation_type' => 'major', 'violation_name' => 'Preventing or Threatening', 'grounds' => 'any pupil or student personnel from entering the school premises, attending classes, or discharging their duties'],
            ['violation_type' => 'major', 'violation_name' => 'Forging or tampering school records', 'grounds' => ''],
            ['violation_type' => 'major', 'violation_name' => 'Securing or using forged school records, forms, and documents', 'grounds' => ''],
            ['violation_type' => 'major', 'violation_name' => 'Stealing or attempting to steal', 'grounds' => 'from the school premises or any member from the school community within school premises'],
            ['violation_type' => 'major', 'violation_name' => 'Cheating', 'grounds' => ''],
            ['violation_type' => 'major', 'violation_name' => 'Damaging school properties', 'grounds' => 'computers, and other equipment through negligence or threatening to damage school property'],
            ['violation_type' => 'major', 'violation_name' => 'Unauthorized pressing of the alarm system', 'grounds' => ''],
            ['violation_type' => 'major', 'violation_name' => 'Damaging of property', 'grounds' => 'of the school personnel or any member of the school community'],
            ['violation_type' => 'major', 'violation_name' => 'Using vulgar, indecent words', 'grounds' => 'and/or insulting language against any person inside school premises'],
            ['violation_type' => 'major', 'violation_name' => 'Verbal or non-verbal communication', 'grounds' => 'and/or willful unethical provocative body exposure'],
            ['violation_type' => 'major', 'violation_name' => 'Display/possession/distribution of pornographic materials', 'grounds' => ''],
            ['violation_type' => 'major', 'violation_name' => 'Immorality', 'grounds' => ''],
            ['violation_type' => 'major', 'violation_name' => 'Tampering and or using others school ID', 'grounds' => ''],
            ['violation_type' => 'major', 'violation_name' => 'Malversation of Students/Organizations Funds', 'grounds' => ''],
            ['violation_type' => 'major', 'violation_name' => 'Creating websites or pages in all social media platforms', 'grounds' => 'using the logo with the name of RMMC without permission'],
            ['violation_type' => 'major', 'violation_name' => 'Disseminating false announcements or information', 'grounds' => ''],
            ['violation_type' => 'major', 'violation_name' => 'Making false accusation/statement against any member of the school', 'grounds' => ''],
            ['violation_type' => 'major', 'violation_name' => 'Capturing or taking pictures/screenshots or videos', 'grounds' => 'and posting it to social media platforms without consent of the captured individual that doesnt serve educational purposes'],
        ];

        foreach ($violations as $violation) {
            DB::table('violations')->insert($violation);
        }
    }
}