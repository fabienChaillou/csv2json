<?php

namespace Command;

use DI\Container;
use Exception\InvalidArgumentException;
use Input\InputType;
use Output\OutputInterface;

class Csv2JsonCommand extends Command
{
    const NAME = 'csv2json';

    const ARGUMENTS_VALID = [
        '--fields',
        '--aggregate',
        '--desc',
        '--pretty',
    ];

    protected function configure()
    {
        $this
            ->setName(static::NAME)
            ->setDescription('Converte to file csv by json object PHP!')
        ;
    }

    public function execute()
    {
        $reader = Container::getReader();
        $formater = Container::getDataFormater();

        $data = $reader->parse(dirname(__DIR__) . '/../' . Container::PATH_DATA, Container::CSV_FILE_NAME);

        $data = $formater->format($data, $this->input->getArguments());

        foreach ($data as $key => $value) {
            $this->output->write(sprintf('todo convert file to json!', $value));

        }

        $this->output->write('la commande' . self::NAME . ' est terminée!');

        return OutputInterface::SUCCESS;
    }

    public function initialize(array $args)
    {
        $args = $this->validateArguments($args);
        var_dump($args);
die();
        parent::initialize($args);
        die();
    }

    private function validateArguments(array $args): array
    {
        unset($args[0]);

        if (
            count($args) < 1 ||
            !$this->getFilesystem()->exists(dirname(__DIR__) . '/..' . Container::PATH_DATA . '/' . $args[1])
        )
        {
            throw new InvalidArgumentException('File argument not found!');
        }

        $args['file'] = $args[1];
        unset($args[1]);

        foreach ($args  as $arg) {
            if (!preg_match('/^--/', $arg) || $args['file']) {
                continue;
            }

            if (!in_array($arg, self::ARGUMENTS_VALID))
            {
                throw new InvalidArgumentException(sprintf('%s argument is not valid!', $arg));
            }
        }

        return $args;
    }

    private function getFilesystem()
    {
        return Container::getFilesystem();
    }

}
