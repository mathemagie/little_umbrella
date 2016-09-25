#include <Process.h>
#include <Bridge.h>
#include <Servo.h>

const int ledPin = 13; 
boolean setupgeo = false;
String cmd;

Servo monServo;

void setup() {
  Bridge.begin();   // Initialize the Bridge
   pinMode(ledPin, OUTPUT);
   monServo.attach(9); 
   setupGeo();
}

void setupGeo() {
  Process p;
  Serial.println("setup geo"); 
  String result;

  p.runShellCommandAsynchronously("/usr/bin/setcity");
  while(p.running());  
 // Read command output. runShellCommand() should have passed "Signal: xx&":
    while (p.available()) {
         char c = p.read();
        result += c;
        //Serial.println(c);
       
  }
  Serial.println(result);
}
  
void loop() {
  
  if (setupgeo == false) {
    setupGeo();
    setupgeo = true;
  }
  
   
  Process p;
  // This command line runs the WifiStatus script, (/usr/bin/pretty-wifi-info.lua), then 
  // sends the result to the grep command to look for a line containing the word
  // "Signal:"  the result is passed to this sketch:
  p.runShellCommand("/usr/bin/curl http://api.littleumbrella.io/v2/?id_parapluie=1");

  // do nothing until the process finishes, so you get the whole output:
  while(p.running());  

  // Read command output. runShellCommand() should have passed "Signal: xx&":
  while (p.available()) {
    int result = p.parseInt();          // look for an integer
    if (result == 1) {
      //digitalWrite(ledPin, HIGH);//bug in parsing process
       monServo.write(180);
       Serial.println("ouvert - il va pleuvoir"); 
    }
   
    if (result == 0) {
        //digitalWrite(ledPin, LOW);//bug in parsing process
         monServo.write(0);
         Serial.println("fermé - il ne va pas pleuvoir");
    }
  
    
  } 
  delay(5000);  // wait 5 seconds before you do it again
}
