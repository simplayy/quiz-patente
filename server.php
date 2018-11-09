

<?php
error_reporting(E_ALL);

/* Allow the script to hang around waiting for connections. */
set_time_limit(0);

/* Turn on implicit output flushing so we see what we're getting as it comes in. */
ob_implicit_flush();

$address = '127.0.0.1';

$port = "5000";

// create a streaming socket, of type TCP/IP
$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

socket_set_option($sock, SOL_SOCKET, SO_REUSEADDR, 1);

socket_bind($sock, $address, $port);

socket_listen($sock);

// create a list of all the clients that will be connected to us..
// add the listening socket to this list
$clients = array($sock);

while (true)
{

    // create a copy, so $clients doesn't get modified by socket_select()
    $read = $clients;
    $write = null;
    $except = null;

    // get a list of all the clients that have data to be read from
    // if there are no clients with data, go to next iteration
    if (socket_select($read, $write, $except, 0) < 1)
        {continue;}

    // check if there is a client trying to connect
    if (in_array($sock, $read))
    {

        $clients[] = $newsock = socket_accept($sock);

       // socket_write($newsock, "There are ".(count($clients) - 1)." client(s) connected to the server\n");

        socket_getpeername($newsock, $ip, $port);
        echo "New client connected: {$ip}\n";

        $key = array_search($sock, $read);
        unset($read[$key]);

    }

    // loop through all the clients that have data to read from
    foreach ($read as $read_sock)
    {

        // read until newline or 1024 bytes
        // socket_read while show errors when the client is disconnected, so silence the error messages
        $data = @socket_read($read_sock, 4096, PHP_BINARY_READ);

        // check if the client is disconnected
        if ($data === false)
        {
            // remove client for $clients array
            $key = array_search($read_sock, $clients);
            unset($clients[$key]);
            echo "client disconnected.\n";
            continue;
        }

        $data = trim($data);
	$arr = explode("+", $data);
        if (!empty($data))
        {
		// nome di host
		$host = "localhost";
		// username dell'utente in connessione
		$user = "root";
		// password dell'utente
		$password = "";
		//nome database
		$dbname="patente";

		// stringa di connessione al DBMS
		$connessione = new mysqli($host, $user, $password, $dbname);
    echo "ciao";
		// verifica su eventuali errori di connessione
		if ($connessione->connect_errno) {
		    echo "Connessione fallita: ". $connessione->connect_error . ".";
		    exit();
		}

		$sql = "SELECT risposta FROM quiz where id=$arr[1]";
		$result = $connessione->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {

			if($arr[0]==$row["risposta"]) socket_write($newsock, "Risposta Esatta !!\n");
			else socket_write($newsock, "Risposta Sbagliata !!\n");
		    }
		} else {
		    echo "0 results";
		}

		// chiusura della connessione
		$connessione->close();
            echo " send {$data}\n";


            // do sth..

            // send some message to listening socket
            socket_write($read_sock, $send_data);

            // send this to all the clients in the $clients array (except the first one, which is a listening socket)
            foreach ($clients as $send_sock)
            {
                if ($send_sock == $sock)
                    continue;

  //              socket_write($send_sock, $data);

            } // end of broadcast foreach
        }

    } // end of reading foreach
}

// close the listening socket
socket_close($sock);


?>
