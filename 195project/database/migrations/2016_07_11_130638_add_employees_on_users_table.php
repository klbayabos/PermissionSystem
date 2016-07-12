<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmployeesOnUsersTable extends Migration
{
     public function up()
    {
		// add jon & kath
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('Jon Aruta', 'jvaruta@up.edu.ph', '1', '1'),
							('Kathleen Bayabos', 'klbayabos@up.edu.ph', '1', '1')
			");
		});
		
		
		// add all admin employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('Mary Ann Angeles', 'mbangeles@up.edu.ph', '1', '7'),
							('Nicalyn Clamor', 'nvclamor@up.edu.ph', '1', '7'),
							('Alexander Cunanan', 'ascunanan@up.edu.ph', '1', '5'),
							('Arnulfo Inocencio', 'aginocencio@up.edu.ph', '1', '6')
			");
		});
		
		// add all Change Management employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('Dr. Jaime Caro', 'jdlcaro@up.edu.ph', '2', '1'),
							('Ruel Madriaga', 'rpmadriaga@up.edu.ph', '2', '7'),
							('John Angelo Labuguen', 'jclabuguen1@up.edu.ph', '2', '7')
			");
		});
		
		// add all Content Development employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('Alyssa Batu', 'anbatu@up.edu.ph', '3', '7'),
							('Sarah Grace Cortejos', 'szcortejos@up.edu.ph', '3', '7'),
							('Triccie Marie Obligacion', 'tvobligacion@up.edu.ph', '3', '7'),
							('Corinne Ann Renes', 'cgrenes@up.edu.ph', '3', '7'),
							('Rafaela Anne Rivera', 'rprivera@up.edu.ph', '3', '7'),
							('Alberto Sagario', 'avsagario@up.edu.ph', '3', '7'),
							('Sarah Salvio', 'srsalvio@up.edu.ph', '3', '6')
			");
		});
		
		// add all EIS employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('Ryan Steven Caro', 'rdcaro@up.edu.ph', '4', '7'),
							('Charisse May Dalida', 'cmdalida@up.edu.ph', '4', '7'),
							('Ma Antonette Parkes', 'mgparkes@up.edu.ph', '4', '7'),
							('Dr. Annette Lagman', 'aglagman@up.edu.ph', '4', '6')		
			");
		});
		
		
		// add all FMIS employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('Juvy Camua', 'jecamua@up.edu.ph', '5', '7'),
							('Efren Ver Sia', 'emsia@up.edu.ph', '5', '7'),
							('Paul Jason Perez', 'pvperez1@up.edu.ph', '5', '7'),
							('Carlo Martin Evangelista', 'cbevangelista1@up.edu.ph', '5', '7'),
							('Kevin Paul Arceleone Basinillo', 'kjbasinillo1@up.edu.ph', '5', '7'),
							('Christopher Jay Garbo', 'cfgarbo@up.edu.ph', '5', '7'),
							('Kervin Maranan', 'kcmaranan@up.edu.ph', '5', '7'),
							('Claudio Olar Jr', 'cmolar@up.edu.ph', '5', '7'),
							('Kenex Carl Mina', 'kcmina1@up.edu.ph', '5', '7'),
							('Paolo Dizon', 'padizon1@up.edu.ph', '5', '7'),
							('James Bailey Bagtas', 'jrbagtas@up.edu.ph', '5', '7')
			");
		});
		
		
		// add all HRIS employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('Vincent Teodosio', 'vpteodosio@up.edu.ph', '6', '6'),
							('Winson Rei Gasis', 'wdgasis@up.edu.ph', '6', '7'),
							('Precious Joy Dizon', 'pudizon1@up.edu.ph', '6', '7'),
							('Mark Anthony Hamor', 'mmhamor@up.edu.ph', '6', '7'),
							('Christian Carlo Liwalas', 'cmliwalas@up.edu.ph', '6', '7'),
							('Jerald Baluyot', 'jtbaluyot@up.edu.ph', '6', '7'),
							('Gerald Roy Campanano', 'gdcampanano@up.edu.ph', '6', '7'),
							('Leo Mercene Ochoa', 'lsochoa@up.edu.ph', '6', '7')
			");
		});
		
		
		// add all IS employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('JR Flores Respino', 'jurespino@up.edu.ph', '7', '6'),
							('Cheska Mae Lucas', 'cclucas1@up.edu.ph', '7', '7')
			");
		});
		
		
		// add all ITO/Helpdesk employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('Rommel Feria', 'rpferia@up.edu.ph', '8', '4'),
							('Jason Balais', 'jrbalais@up.edu.ph', '8', '7'),
							('Vic Angelo Mamaril', 'vic@up.edu.ph', '8', '7'),
							('Nanette SJ Baris', 'nsbaris@up.edu.ph', '8', '7'),
							('Maria Fe Dolores Del Rosario', 'fedelrosario@up.edu.ph', '8', '7'),
							('Gromico Chopitea', 'micochops@up.edu.ph', '8', '7'),
							('Julius Cesar Lo', 'jclo@up.edu.ph', '8', '7'),
							('Abram Chua', 'acchua@up.edu.ph', '8', '7'),
							('Micomar Luigi Bala', 'mcbala@up.edu.ph', '8', '7'),
							('Herbert Gerard Villafranca', 'htvillafranca@up.edu.ph', '8', '7'),
							('Ma. Christine Sanchez', 'mcsanchez3@up.edu.ph', '8', '7'),
							('Nina Kamilla Quiazon', 'njquiazon@up.edu.ph', '8', '7'),
							('Nilo Costelo', 'nicostelo@up.edu.ph', '8', '7'),
							('Jan Brian Paul Ebora', 'jpebora@up.edu.ph', '8', '7'),
							('Gem Angel Tupaz', 'gptupaz@up.edu.ph', '8', '7'),
							('William Nikko Monzon', 'wcmonzon@up.edu.ph', '8', '7')
			");
		});
		
		
		// add all QA employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('Christine Joyce Salvatierra', 'cbsalvatierra@up.edu.ph', '9', '6'),
							('Hyacinth Sison', 'hqsison@up.edu.ph', '9', '7'),
							('Julius Ermitanio', 'jaermitanio@up.edu.ph', '9', '7'),
							('Caren Cyel Mararac', 'cgmararac@up.edu.ph', '9', '7')
			");
		});
		
		
		// add all SAIS employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('Hayde Arandia', 'hbarandia@up.edu.ph', '10', '7'),
							('Neriah Ato', 'ndato@up.edu.ph', '10', '7'),
							('Elizabeth Capalungan', 'eecapalungan@up.edu.ph', '10', '7'),
							('Alexis Dujua', 'apdujua@up.edu.ph', '10', '7'),
							('Leandro Dax Garde', 'ltgarde@up.edu.ph', '10', '7'),
							('Stephen Ko', 'stko1@up.edu.ph', '10', '6'),
							('Ara Leann Laranang', 'aelaranang@up.edu.ph', '10', '7'),
							('Kim Justin Muncal', 'knmuncal@up.edu.ph', '10', '7'),
							('Mark Paolo Navata', 'mpnavata@up.edu.ph', '10', '7'),
							('Keith Emmanuel Tayzon', 'kmtayzon@up.edu.ph', '10', '7'),
							('Bona Rae Villarta', 'bpvillarta1@m.up.edu.ph', '10', '7'),
							('Michelle Eslabra', 'mbeslabra@up.edu.ph', '10', '7'),
							('Caryll Jeremy Babula', 'cmbabula@up.edu.ph', '10', '7'),
							('Amelita Jorda', 'asjorda@up.edu.ph', '10', '7'),
							('Claudine Baroma', 'cbbaroma@up.edu.ph', '10', '7'),
							('Gian Carlo Tolentino', 'gbtolentino@up.edu.ph', '10', '7')
			");
		});
		
		
		// add all SAIS OU employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('Ronaldo De Jesus', 'rcdejesus4@up.edu.ph', '11', '6'),
							('Francis Alfred Xavier Viray III', 'fcviray1@up.edu.ph', '11', '7'),
							('Hazael King Espinosa', 'haespinosa@up.edu.ph', '11', '7'),
							('Rachelle Espinosa', 'raespinosa1@up.edu.ph', '11', '7'),
							('Rachel Joy Gabrido', 'rcgabrido@up.edu.ph', '11', '7'),
							('Ma. Cristina Cassandra Vitaliz', 'mfvitaliz@up.edu.ph', '11', '7')
			");
		});
		
		
		// add all UI/Mobile employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('Joper Cunanan', 'jlcunanan1@up.edu.ph', '12', '7'),
							('Amanda Legasto', 'aplegasto@up.edu.ph', '12', '7'),
							('Domingo, Patrick Leiniel ', 'phdomingo@up.edu.ph', '12', '7'),
							('David Paul Relao', 'darelao@up.edu.ph', '12', '7')
			");
		});
    }
	
    public function down(){
        Schema::drop('users');
    }
}
