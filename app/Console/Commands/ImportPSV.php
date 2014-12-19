<?php namespace Courses\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;

use Courses\Course;
use Courses\Instructor;
use Courses\SectionType;
use Courses\Subject;

class ImportPSV extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'import:psv';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Imports pipe separated files.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$file = $this->argument('psv');

		if ( ! file_exists($file))
		{
			$this->error(sprintf('File "%s" could not be found.'));
			return -1;
		}

		$i = 0;
		$headers = null;

		$config = new LexerConfig();
		$config->setDelimiter('|');

		$lexer = new Lexer($config);
		$interpreter = new Interpreter();
		$interpreter->addObserver(function(array $row) use (&$i, &$headers)
		{
			$row = array_splice($row, 1);

			if (is_null($headers))
			{
				$headers = $row;
				return;
			}

			try
			{
				$params = array_combine($headers, $row);
				// $params['subject_id'] = $this->getSubjectId($params['subject_id']);
				// $params['email'] = null;
				print_r($params);
				SectionType::create($params);
				echo $i++."\n";

				// Subject::create($params);
				// throw new \Exception('ye');
				
			}
			catch (QueryException $e)
			{
				$this->error($e->getMessage());
				$this->info(sprintf('Skipping row #%s due to duplicate entry', $i));
			}
		});

		$lexer->parse($file, $interpreter);
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['psv', InputArgument::REQUIRED, 'A pipe separated file.'],
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
		];
	}

}
