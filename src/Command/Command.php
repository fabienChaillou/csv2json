<?php

namespace Command;

use DI\Container;
use Filesystem\Terminal;
use Input\Input;
use Input\InputInterface;
use Output\Output;
use Output\OutputInterface;

class Command implements CommandInterface
{
    private $name;
    private $description;

    /**
     * @var OutputInterface
     */
    protected $output;

    /**
     * @var InputInterface
     */
    protected $input;

    /**
     * @var Terminal
     */
    protected $terminal;

    public function __construct(string $name = null)
    {
        $this->output   = CommandFactory::createOutputInterface();
        $this->input    = CommandFactory::createInputInterface();
        $this->terminal = Container::getTerminal();

        $this->configure();
    }

    protected function configure(){}
    public function execute(){}

    protected function initialize(array $args)
    {
        /**
         * @todo add callback ton set arguments
         */

//        $this->input->setArgument('file', $args[1]);
//        $this->input->setArgument('fields', $args['--fields']);
//        $this->input->setArgument('aggregate', $args['--aggregate']);
//        $this->input->setArgument('desc', $args['--desc']);
//        $this->input->setArgument('pretty', $args['--pretty']);

        $invoker = function (InputInterface $input) use ($args) {
            $parameters = array_merge(
                [
                    // Injection by parameter name
                    'input' => $input,
                    'output' => $output,
                    // Injections by type-hint
                    InputInterface::class => $input,
                    OutputInterface::class => $output,
                    Input::class => $input,
                    Output::class => $output,
                ],
                // Arguments and options are injected by parameter names
                $input->$arg['arg'],
                $input->$arg['option']
            );
        };
    }

    public function setName(string $name): self
    {
        $this->name = trim($name);

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
