<?php
use PHPUnit\Framework\TestCase;
use App\Controllers\ControllerAccueilMedical;
use App\Models\ModeleRecupererPatientNoSQL;

class ControllerAccueilMedicalTest extends TestCase
{
    private $controller;

    protected function setUp(): void
    {
        parent::setUp();

        $this->controller = $this->getMockBuilder(ControllerAccueilMedical::class)
                                 ->disableOriginalConstructor()
                                 ->onlyMethods(['redirect', 'terminate', 'sessionExists', 'getParam', 'getPost'])
                                 ->getMock();

        // Simuler que sessionExists retourne toujours true par défaut
        $this->controller->method('sessionExists')->willReturn(true);

        // Configurer la méthode 'redirect' pour simuler une redirection
        $this->controller->method('redirect')->will($this->returnCallback(function ($url) {
            echo "Redirected to {$url}";
        }));

        // Configurer 'terminate' pour lancer une exception lorsqu'elle est appelée
        $this->controller->method('terminate')->will($this->returnCallback(function () {
            throw new Exception("Terminated script");
        }));
    }

    /**
     * @test
     */
    public function constructorWithoutSession()
    {
        $this->controller->method('sessionExists')->willReturn(false);
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Terminated script");
        
        $this->controller->__construct([]);
    }

    /**
     * @test
     */
    public function constructorWithSessionValid()
    {
        $this->controller->method('sessionExists')->willReturn(true);
        ob_start();
        $this->controller->__construct([]);
        $output = ob_get_clean();

        $this->assertEmpty($output);
    }

    /**
     * @test
     */
    public function patientsFunctionality()
    {
        $modelMock = $this->createMock(ModeleRecupererPatientNoSQL::class);
        $modelMock->expects($this->once())
                  ->method('recupererPatientsNoSQL')
                  ->willReturn([]);

        // Injecter le mock dans le contrôleur
        $this->controller->expects($this->any())
                         ->method('getPost')
                         ->will($this->returnCallback(function ($key, $default = null) {
                            return $_POST[$key] ?? $default;
                         }));

        $_POST['chercher'] = true;
        $_POST['prenom'] = 'Alice';
        $_POST['nom'] = 'Wonderland';
        $_POST['dateNaissance'] = '1990-01-01';
        $_POST['num_sec'] = '123456789';

        ob_start();
        $this->controller->patients();
        $output = ob_get_clean();

        $this->assertEmpty($output);
    }
}
