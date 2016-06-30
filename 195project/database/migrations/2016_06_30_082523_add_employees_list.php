<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddemployeesList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {// add all admin employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('Mary Ann Angeles', 'mbangeles@up.edu.ph', '1', '6'),
							('Nicalyn Clamor', 'nvclamor@up.edu.ph', '1', '6'),
							('Alexander Cunanan', 'ascunanan@up.edu.ph', '1', '5'),
							('Arnulfo Inocencio', 'aginocencio@up.edu.ph', '1', '7')
			");
		});
		
		// add all Change Management employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('Dr. Jaime Caro', 'jdlcaro@up.edu.ph', '2', '2'),
							('Ruel Madriaga', 'rpmadriaga@up.edu.ph', '2', '6'),
							('John Angelo Labuguen', 'jclabuguen1@up.edu.ph', '2', '6')
			");
		});
		
		// add all Content Development employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('Alyssa Batu', 'anbatu@up.edu.ph', '3', '6'),
							('Sarah Grace Cortejos', 'szcortejos@up.edu.ph', '3', '6'),
							('Triccie Marie Obligacion', 'tvobligacion@up.edu.ph', '3', '6'),
							('Corinne Ann Renes', 'cgrenes@up.edu.ph', '3', '6'),
							('Rafaela Anne Rivera', 'rprivera@up.edu.ph', '3', '6'),
							('Alberto Sagario', 'avsagario@up.edu.ph', '3', '6'),
							('Sarah Salvio', 'srsalvio@up.edu.ph', '3', '7')
			");
		});
		
		// add all EIS employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('Ryan Steven Caro', 'rdcaro@up.edu.ph', '4', '6'),
							('Charisse May Dalida', 'cmdalida@up.edu.ph', '4', '6'),
							('Ma Antonette Parkes', 'mgparkes@up.edu.ph', '4', '6'),
							('Dr. Annette Lagman', 'aglagman@up.edu.ph', '4', '7')		
			");
		});
		
		
		// add all FMIS employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('Juvy Camua', 'jecamua@up.edu.ph', '5', '6'),
							('Efren Ver Sia', 'emsia@up.edu.ph', '5', '6'),
							('Paul Jason Perez', 'pvperez1@up.edu.ph', '5', '6'),
							('Carlo Martin Evangelista', 'cbevangelista1@up.edu.ph', '5', '6'),
							('Kevin Paul Arceleone Basinillo', 'kjbasinillo1@up.edu.ph', '5', '6'),
							('C6topher Jay Garbo', 'cfgarbo@up.edu.ph', '5', '6'),
							('Kervin Maranan', 'kcmaranan@up.edu.ph', '5', '6'),
							('Claudio Olar Jr', 'cmolar@up.edu.ph', '5', '6'),
							('Kenex Carl Mina', 'kcmina1@up.edu.ph', '5', '6'),
							('Paolo Dizon', 'padizon1@up.edu.ph', '5', '6'),
							('James Bailey Bagtas', 'jrbagtas@up.edu.ph', '5', '6')
			");
		});
		
		
		// add all HRIS employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('Vincent Teodosio', 'vpteodosio@up.edu.ph', '6', '7'),
							('Winson Rei Gasis', 'wdgasis@up.edu.ph', '6', '6'),
							('Precious Joy Dizon', 'pudizon1@up.edu.ph', '6', '6'),
							('Mark Anthony Hamor', 'mmhamor@up.edu.ph', '6', '6'),
							('C6tian Carlo Liwalas', 'cmliwalas@up.edu.ph', '6', '6'),
							('Jerald Baluyot', 'jtbaluyot@up.edu.ph', '6', '6'),
							('Gerald Roy Campanano', 'gdcampanano@up.edu.ph', '6', '6'),
							('Leo Mercene Ochoa', 'lsochoa@up.edu.ph', '6', '6')
			");
			/**
							('Rabelais Medina', '', '6', '6'),					// missing up mail account
							('Ericka Joy Cervantes', '', '6', '6')				// missing up mail account
			**/
		});
		
		
		// add all IS employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('JR Flores Respino', 'jurespino@up.edu.ph', '7', '7'),
							('Cheska Mae Lucas', 'cclucas1@up.edu.ph', '7', '6')
			");
		});
		
		
		// add all ITO/Helpdesk employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('Rommel Feria', 'rpferia@up.edu.ph', '8', '4'),
							('Jason Balais', 'jrbalais@up.edu.ph', '8', '6'),
							('Vic Angelo Mamaril', 'vic@up.edu.ph', '8', '6'),
							('Nanette SJ Baris', 'jrbal', '8', '6'),
							('Maria Fe Dolores Del Rosario', 'fedelrosario@up.edu.ph', '8', '6'),
							('Gromico Chopitea', 'micochops@up.edu.ph', '8', '6'),
							('Julius Cesar Lo', 'jclo@up.edu.ph', '8', '6'),
							('Abram Chua', 'acchua@up.edu.ph', '8', '6'),
							('Micomar Luigi Bala', 'mcbala@up.edu.ph', '8', '6'),
							('Herbert Gerard Villafranca', 'htvillafranca@up.edu.ph', '8', '6'),
							('Ma. Christine Sanchez', 'mcsanchez3@up.edu.ph', '8', '6'),
							('Nina Kamilla Quiazon', 'njquiazon@up.edu.ph', '8', '6'),
							('Nilo Costelo', 'nicostelo@up.edu.ph', '8', '6'),
							('Jan Brian Paul Ebora', 'jpebora@up.edu.ph', '8', '6'),
							('Gem Angel Tupaz', 'gptupaz@up.edu.ph', '8', '6'),
							('William Nikko Monzon', 'wcmonzon@up.edu.ph', '8', '6')
			");
		});
		
		
		// add all QA employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('C6tine Joyce Salvatierra', 'cbsalvatierra@up.edu.ph', '9', '7'),
							('Hyacinth Sison', 'hqsison@up.edu.ph', '9', '6'),
							('Julius Ermitanio', 'jaermitanio@up.edu.ph', '9', '6'),
							('Caren Cyel Mararac', 'cgmararac@up.edu.ph', '9', '6')
			");
			/**
							('David, Eric', '', '9', '6')							// missing up mail account
			**/
		});
		
		
		// add all SAIS employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('Hayde Arandia', 'hbarandia@up.edu.ph', '10', '6'),
							('Neriah Ato', 'ndato@up.edu.ph', '10', '6'),
							('Elizabeth Capalungan', 'eecapalungan@up.edu.ph', '10', '6'),
							('Alexis Dujua', 'apdujua@up.edu.ph', '10', '6'),
							('Leandro Dax Garde', 'ltgarde@up.edu.ph', '10', '6'),
							('Stephen Ko', 'stko1@up.edu.ph', '10', '7'),
							('Ara Leann Laranang', 'aelaranang@up.edu.ph', '10', '6'),
							('Kim Justin Muncal', 'knmuncal@up.edu.ph', '10', '6'),
							('Mark Paolo Navata', 'mpnavata@up.edu.ph', '10', '6'),
							('Keith Emmanuel Tayzon', 'kmtayzon@up.edu.ph', '10', '6'),
							('Bona Rae Villarta', 'bpvillarta1@m.up.edu.ph', '10', '6'),
							('Michelle Eslabra', 'mbeslabra@up.edu.ph', '10', '6'),
							('Caryll Jeremy Babula', 'cmbabula@up.edu.ph', '10', '6'),
							('Amelita Jorda', 'asjorda@up.edu.ph', '10', '6'),
							('Claudine Baroma', 'cbbaroma@up.edu.ph', '10', '6'),
							('Gian Carlo Tolentino', 'gbtolentino@up.edu.ph', '10', '6')
			");
			/**
							('Sheherazade Ocampo II', '', '10', '6'),				// missing up mail account
							('Franklin David Ang', '', '10', '6')					// missing up mail account
			**/
		});
		
		
		// add all SAIS OU employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('Ronaldo De Jesus', 'rcdejesus4@up.edu.ph', '11', '7'),
							('Francis Alfred Xavier Viray III', 'fcviray1@up.edu.ph', '11', '6'),
							('Hazael King Espinosa', 'haespinosa@up.edu.ph', '11', '6'),
							('Rachelle Espinosa', 'raespinosa1@up.edu.ph', '11', '6'),
							('Rachel Joy Gabrido', 'rcgabrido@up.edu.ph', '11', '6'),
							('Ma. Cristina Cassandra Vitaliz', 'mfvitaliz@up.edu.ph', '11', '6')
			");
			/**
							('Marie Karen Enrile', '', '11', '6'),				// missing up mail account
			**/		
		});
		
		
		// add all UI/Mobile employees
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `users` (`name`, `email`, `team_id`, `type_id`) VALUES
							('Joper Cunanan', 'jlcunanan1@up.edu.ph', '12', '6'),
							('Amanda Legasto', 'aplegasto@up.edu.ph', '12', '6'),
							('Domingo, Patrick Leiniel ', 'phdomingo@up.edu.ph', '12', '6'),
							('David Paul Relao', 'darelao@up.edu.ph', '12', '6')
			");
			/**
							('Karen Pajarito', '', '12', '7')				// missing up mail account
			**/
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
