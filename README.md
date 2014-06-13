auth-browserid
==============

PHP verification library for the BrowserID / Persona authentication system

# Installation

Since this module is not in PEAR yet, you need to copy the `Auth/` directory into your application directly.

# Usage

Once the library is in the right place, you can use it like this:

    $verifier = new Auth_BrowserID('http://localhost:80');
    $result = $verifier->verifyAssertion($_POST['assertion']);

    if ($result->status === 'okay') {
        $email = $result->email;
    }

See the [demo application](/docs/demo.php) for a real-world example of how it works.
