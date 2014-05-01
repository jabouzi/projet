<?php
interface ElectricalDevice
{
    public function power_on();
    public function power_off();
}
interface FrequencyTuner
{
    public function get_frequencey();
    public function set_frequency($f);
}

class ElectricFan implements ElectricalDevice
{
    public function power_on()
    {
        echo "turns power on for electrical fan " . PHP_EOL;
    }
    public function power_off()
    {
        echo "turns power off for electrical fan " . PHP_EOL;
    }
}

class MicrowaveOven implements ElectricalDevice
{
    public function power_on()
    {
        echo "turns power on for Microwave " . PHP_EOL;
    }
    public function power_off()
    {
        echo "turns power on for Microwave " . PHP_EOL;
    }
}

class StereoReceiver implements ElectricalDevice, FrequencyTuner
{
    private $freq;
    public function power_on()
    {
        echo "turns power on for Stereo Receiver " . PHP_EOL;
    }
    public function power_off()
    {
        echo "turns power on for Stereo Receiver " . PHP_EOL;
    }
    public function set_frequency($f)
    {
        $this->freq = $f;
    }
    public function get_frequencey()
    {
        echo "Freq of Stereo Receiver : " . $this->freq . PHP_EOL;
    }
}

class CellPhone implements ElectricalDevice, FrequencyTuner
{
    private $freq;
    public function power_on()
    {
        echo "turns power on for CellPhone " . PHP_EOL;
    }
    public function power_off()
    {
        echo "turns power on for CellPhone " . PHP_EOL;
    }
    public function set_frequency($f)
    {
        $this->freq = $f;
    }
    public function get_frequencey()
    {
        echo "Freq of CellPhone : " . $this->freq . PHP_EOL;
    }
}

// main
$myElectricalFan = new ElectricFan();
$myElectricalFan->power_on();
$myElectricalFan->power_off();
$myCell = new CellPhone();
$myCell->power_on();
$myCell->power_off();
$myCell->set_frequency(200);
$myCell->get_frequencey();
