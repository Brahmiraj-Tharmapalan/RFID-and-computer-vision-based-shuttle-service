//******************************libraries*******************************
//RFID-----------------------------
#include <SPI.h>
#include <MFRC522.h>
//NodeMCU--------------------------
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
//************************************************************************
#define SS_PIN  D2  //D2
#define RST_PIN D1  //D1
#define BUZZER_PIN D3 // Use the appropriate digital pin where the buzzer is connected
//************************************************************************
MFRC522 mfrc522(SS_PIN, RST_PIN);
//************************************************************************
/* Set these to your desired credentials. */
const char *ssid = "Raj_Hunt";
const char *password = "Rajhunt7898@#";
const char *device_token = "82a0354d689d4d19";
//************************************************************************
String URL = "http://fyp-shuttle-service.000webhostapp.com/getdata.php";
String getData, Link;
String OldCardID = "";
unsigned long previousMillis = 0;
//************************************************************************
void setup() {
  delay(1000);
  Serial.begin(115200);
  SPI.begin();
  mfrc522.PCD_Init();
  //---------------------------------------------
  connectToWiFi();
  pinMode(BUZZER_PIN, OUTPUT); // Set the buzzer pin as an output
}
//************************************************************************
void loop() {
  // Check if there's a connection to Wi-Fi or not
  if (!WiFi.isConnected()) {
    connectToWiFi(); // Retry to connect to Wi-Fi
  }
  //---------------------------------------------
  if (millis() - previousMillis >= 15000) {
    previousMillis = millis();
    OldCardID = "";
  }
  delay(50);
  //---------------------------------------------
  // Look for a new card
  if (!mfrc522.PICC_IsNewCardPresent()) {
    return; // Go back to the start of the loop if there is no card present
  }
  // Select one of the cards
  if (!mfrc522.PICC_ReadCardSerial()) {
    return; // If reading the card serial returns 1, the uid struct contains the ID of the read card.
  }
  String CardID = "";
  for (byte i = 0; i < mfrc522.uid.size; i++) {
    CardID += mfrc522.uid.uidByte[i];
  }
  //---------------------------------------------
  if (CardID == OldCardID) {
    return;
  } else {
    OldCardID = CardID;
  }
  //---------------------------------------------
  // Serial.println(CardID);
  SendCardID(CardID);
  digitalWrite(BUZZER_PIN, HIGH); // Turn the buzzer on
  delay(500); // Adjust the delay duration as needed
  digitalWrite(BUZZER_PIN, LOW); // Turn the buzzer off
}
//***********send the Card UID to the website************
void SendCardID(String Card_uid) {
  Serial.println("Sending the Card ID");
  if (WiFi.isConnected()) {
    HTTPClient http;
    //GET Data
    getData = "?card_uid=" + String(Card_uid) + "&device_token=" + String(device_token);
    //GET method
    Link = URL + getData;
    http.begin(Link);
    
    int httpCode = http.GET();
    String payload = http.getString();
    Serial.println(httpCode);
    Serial.println(Card_uid);
    Serial.println(payload);
    Serial.println(Link);

    if (httpCode == 200) {
      if (payload.substring(0, 5) == "login") {
        String user_name = payload.substring(5);
      }
      else if (payload.substring(0, 6) == "logout") {
        String user_name = payload.substring(6);
      }
      else if (payload == "successful") {
        // Handle successful response
      }
      else if (payload == "available") {
        // Handle available response
      }
      delay(100);
      http.end();
    }
  }
}
//*******************connect to the WiFi*****************
void connectToWiFi() {
  WiFi.mode(WIFI_OFF);
  delay(1000);
  WiFi.mode(WIFI_STA);
  Serial.print("Connecting to ");
  Serial.println(ssid);
  WiFi.begin(ssid, password);
  
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("Connected");
  
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
  
  delay(1000);
}
