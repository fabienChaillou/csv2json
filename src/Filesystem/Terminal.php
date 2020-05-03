<?php

namespace Filesystem;

use Output\OutputInterface;

class Terminal
{
    private $descriptorspec = [
        0 => array("pipe", "r"),  // // stdin est un pipe où le processus va lire
        1 => array("pipe", "w"),  // stdout est un pipe où le processus va écrire
        2 => array("file", "/tmp/error-output.txt", "a") // stderr est un fichier
    ];

    private $cwd = '/tmp';
    private $env = array('quelques_options' => 'aeiou');

    public function execute(string $message)
    {
        $out = fopen('php://stdout','w');
        fwrite($out, $message);
        echo "\n";
        fclose($out);

//        $process = proc_open('php', $this->descriptorspec, $pipes, $this->cwd, $this->env);
//
//        if (is_resource($process)) {
//            // $pipes ressemble à :
//            // 0 => fichier accessible en écriture, connecté à l'entrée standard du processus fils
//            // 1 => fichier accessible en lecture, connecté à la sortie standard du processus fils
//            // Toute erreur sera ajoutée au fichier /tmp/error-output.txt
//
/*            fwrite($pipes[0], '<?php print_r($_ENV); ?>');*/
//            fclose($pipes[0]);
//
//            echo stream_get_contents($pipes[1]);
//            fclose($pipes[1]);
//
//            // Il est important que vous fermiez les pipes avant d'appeler
//            // proc_close afin d'éviter un verrouillage.
//            $return_value = proc_close($process);
//
//            echo "La commande a retourné $return_value\n";
//
//        }
    }


    public function write(file $file)
    {
        $process = proc_open('php', $this->descriptorspec, $pipes, $this->cwd, $this->env);

        if (is_resource($process)) {
            // $pipes ressemble à :
            // 0 => fichier accessible en écriture, connecté à l'entrée standard du processus fils
            // 1 => fichier accessible en lecture, connecté à la sortie standard du processus fils
            // Toute erreur sera ajoutée au fichier /tmp/error-output.txt

                    fwrite($pipes[0], '<?php print_r($_ENV); ?>');
            fclose($pipes[0]);

            echo stream_get_contents($pipes[1]);
            fclose($pipes[1]);

            // Il est important que vous fermiez les pipes avant d'appeler
            // proc_close afin d'éviter un verrouillage.
            $return_value = proc_close($process);

            echo "La commande a retourné $return_value\n";

        }
    }
}
