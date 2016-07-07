<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmployeesToUsersTable extends Migration
{
    
    /**
     * Run the migrations.
     *
     * @return void
     */
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
							('Mary Ann Angeles', 'mbangeles@up.edu.ph', '1', '8'),
							('Nicalyn Clamor', 'nvclamor@up.edu.ph', '1', '8'),
							('Alexander Cunanan', 'ascunanan@up.edu.ph', '1', '6'),
							('Arnulfo Inocencio', 'aginocencio@up.edu.ph', '1', '7')
			");
		});
		
		// add all Change Management employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('Dr. Jaime Caro', 'jdlcaro@up.edu.ph', '2', '1'),
							('Ruel Madriaga', 'rpmadriaga@up.edu.ph', '2', '8'),
							('John Angelo Labuguen', 'jclabuguen1@up.edu.ph', '2', '8')
			");
		});
		
		// add all Content Development employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('Alyssa Batu', 'anbatu@up.edu.ph', '3', '8'),
							('Sarah Grace Cortejos', 'szcortejos@up.edu.ph', '3', '8'),
							('Triccie Marie Obligacion', 'tvobligacion@up.edu.ph', '3', '8'),
							('Corinne Ann Renes', 'cgrenes@up.edu.ph', '3', '8'),
							('Rafaela Anne Rivera', 'rprivera@up.edu.ph', '3', '8'),
							('Alberto Sagario', 'avsagario@up.edu.ph', '3', '8'),
							('Sarah Salvio', 'srsalvio@up.edu.ph', '3', '7')
			");
		});
		
		// add all EIS employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('Ryan Steven Caro', 'rdcaro@up.edu.ph', '4', '8'),
							('Charisse May Dalida', 'cmdalida@up.edu.ph', '4', '8'),
							('Ma Antonette Parkes', 'mgparkes@up.edu.ph', '4', '8'),
							('Dr. Annette Lagman', 'aglagman@up.edu.ph', '4', '7')		
			");
		});
		
		
		// add all FMIS employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('Juvy Camua', 'jecamua@up.edu.ph', '5', '8'),
							('Efren Ver Sia', 'emsia@up.edu.ph', '5', '8'),
							('Paul Jason Perez', 'pvperez1@up.edu.ph', '5', '8'),
							('Carlo Martin Evangelista', 'cbevangelista1@up.edu.ph', '5', '8'),
							('Kevin Paul Arceleone Basinillo', 'kjbasinillo1@up.edu.ph', '5', '8'),
							('Christopher Jay Garbo', 'cfgarbo@up.edu.ph', '5', '8'),
							('Kervin Maranan', 'kcmaranan@up.edu.ph', '5', '8'),
							('Claudio Olar Jr', 'cmolar@up.edu.ph', '5', '8'),
							('Kenex Carl Mina', 'kcmina1@up.edu.ph', '5', '8'),
							('Paolo Dizon', 'padizon1@up.edu.ph', '5', '8'),
							('James Bailey Bagtas', 'jrbagtas@up.edu.ph', '5', '8')
			");
		});
		
		
		// add all HRIS employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('Vincent Teodosio', 'vpteodosio@up.edu.ph', '6', '7'),
							('Winson Rei Gasis', 'wdgasis@up.edu.ph', '6', '8'),
							('Precious Joy Dizon', 'pudizon1@up.edu.ph', '6', '8'),
							('Mark Anthony Hamor', 'mmhamor@up.edu.ph', '6', '8'),
							('Christian Carlo Liwalas', 'cmliwalas@up.edu.ph', '6', '8'),
							('Jerald Baluyot', 'jtbaluyot@up.edu.ph', '6', '8'),
							('Gerald Roy Campanano', 'gdcampanano@up.edu.ph', '6', '8'),
							('Leo Mercene Ochoa', 'lsochoa@up.edu.ph', '6', '8')
			");
		});
		
		
		// add all IS employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('JR Flores Respino', 'jurespino@up.edu.ph', '7', '7'),
							('Cheska Mae Lucas', 'cclucas1@up.edu.ph', '7', '8')
			");
		});
		
		
		// add all ITO/Helpdesk employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('Rommel Feria', 'rpferia@up.edu.ph', '8', '5'),
							('Jason Balais', 'jrbalais@up.edu.ph', '8', '8'),
							('Vic Angelo Mamaril', 'vic@up.edu.ph', '8', '8'),
							('Nanette SJ Baris', 'nsbaris@up.edu.ph', '8', '8'),
							('Maria Fe Dolores Del Rosario', 'fedelrosario@up.edu.ph', '8', '8'),
							('Gromico Chopitea', 'micochops@up.edu.ph', '8', '8'),
							('Julius Cesar Lo', 'jclo@up.edu.ph', '8', '8'),
							('Abram Chua', 'acchua@up.edu.ph', '8', '8'),
							('Micomar Luigi Bala', 'mcbala@up.edu.ph', '8', '8'),
							('Herbert Gerard Villafranca', 'htvillafranca@up.edu.ph', '8', '8'),
							('Ma. Christine Sanchez', 'mcsanchez3@up.edu.ph', '8', '8'),
							('Nina Kamilla Quiazon', 'njquiazon@up.edu.ph', '8', '8'),
							('Nilo Costelo', 'nicostelo@up.edu.ph', '8', '8'),
							('Jan Brian Paul Ebora', 'jpebora@up.edu.ph', '8', '8'),
							('Gem Angel Tupaz', 'gptupaz@up.edu.ph', '8', '8'),
							('William Nikko Monzon', 'wcmonzon@up.edu.ph', '8', '8')
			");
		});
		
		
		// add all QA employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('Christine Joyce Salvatierra', 'cbsalvatierra@up.edu.ph', '9', '7'),
							('Hyacinth Sison', 'hqsison@up.edu.ph', '9', '8'),
							('Julius Ermitanio', 'jaermitanio@up.edu.ph', '9', '8'),
							('Caren Cyel Mararac', 'cgmararac@up.edu.ph', '9', '8')
			");
			/**
							('David, Eric', '', '9', '8')							// missing up mail account
			**/
		});
		
		
		// add all SAIS employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('Hayde Arandia', 'hbarandia@up.edu.ph', '10', '8'),
							('Neriah Ato', 'ndato@up.edu.ph', '10', '8'),
							('Elizabeth Capalungan', 'eecapalungan@up.edu.ph', '10', '8'),
							('Alexis Dujua', 'apdujua@up.edu.ph', '10', '8'),
							('Leandro Dax Garde', 'ltgarde@up.edu.ph', '10', '8'),
							('Stephen Ko', 'stko1@up.edu.ph', '10', '7'),
							('Ara Leann Laranang', 'aelaranang@up.edu.ph', '10', '8'),
							('Kim Justin Muncal', 'knmuncal@up.edu.ph', '10', '8'),
							('Mark Paolo Navata', 'mpnavata@up.edu.ph', '10', '8'),
							('Keith Emmanuel Tayzon', 'kmtayzon@up.edu.ph', '10', '8'),
							('Bona Rae Villarta', 'bpvillarta1@m.up.edu.ph', '10', '8'),
							('Michelle Eslabra', 'mbeslabra@up.edu.ph', '10', '8'),
							('Caryll Jeremy Babula', 'cmbabula@up.edu.ph', '10', '8'),
							('Amelita Jorda', 'asjorda@up.edu.ph', '10', '8'),
							('Claudine Baroma', 'cbbaroma@up.edu.ph', '10', '8'),
							('Gian Carlo Tolentino', 'gbtolentino@up.edu.ph', '10', '8')
			");
		});
		
		
		// add all SAIS OU employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('Ronaldo De Jesus', 'rcdejesus4@up.edu.ph', '11', '7'),
							('Francis Alfred Xavier Viray III', 'fcviray1@up.edu.ph', '11', '8'),
							('Hazael King Espinosa', 'haespinosa@up.edu.ph', '11', '8'),
							('Rachelle Espinosa', 'raespinosa1@up.edu.ph', '11', '8'),
							('Rachel Joy Gabrido', 'rcgabrido@up.edu.ph', '11', '8'),
							('Ma. Cristina Cassandra Vitaliz', 'mfvitaliz@up.edu.ph', '11', '8')
			");
		});
		
		
		// add all UI/Mobile employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('Joper Cunanan', 'jlcunanan1@up.edu.ph', '12', '8'),
							('Amanda Legasto', 'aplegasto@up.edu.ph', '12', '8'),
							('Domingo, Patrick Leiniel ', 'phdomingo@up.edu.ph', '12', '8'),
							('David Paul Relao', 'darelao@up.edu.ph', '12', '8')
			");
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
