  /* 
    Super Mario Bros
    songs available at https://github.com/robsoncouto/arduino-songs
  */

  #define NOTE_C4  262
  #define NOTE_CS4 277
  #define NOTE_D4  294
  #define NOTE_DS4 311
  #define NOTE_E4  330
  #define NOTE_F4  349
  #define NOTE_FS4 370
  #define NOTE_G4  392
  #define NOTE_GS4 415
  #define NOTE_A4  440
  #define NOTE_AS4 466
  #define NOTE_B4  494
  #define NOTE_C5  523
  #define NOTE_CS5 554
  #define NOTE_D5  587
  #define NOTE_DS5 622
  #define NOTE_E5  659
  #define NOTE_F5  698
  #define NOTE_FS5 740
  #define NOTE_G5  784
  #define NOTE_GS5 831
  #define NOTE_A5  880
  #define NOTE_AS5 932
  #define NOTE_B5  988
  #define REST 0

  int melody[] = {
    NOTE_E5,8, NOTE_C5,4, NOTE_A4,8, NOTE_G4,2,
    NOTE_E5,8, NOTE_C5,4, NOTE_G4,8, REST,4, NOTE_GS4,4,
    NOTE_A4,8, NOTE_F5,4, NOTE_F5,8, NOTE_A4,2,
    NOTE_B4,8, NOTE_F5,4, NOTE_F5,8, NOTE_F5,-8, NOTE_E5,-8, NOTE_D5,-8,
    NOTE_C5,8, NOTE_E4,4, NOTE_E4,8, NOTE_C4,2,

    NOTE_C5,-4, NOTE_G4,-4, NOTE_E4,4,
    NOTE_A4,-8, NOTE_B4,-8, NOTE_A4,-8, NOTE_GS4,-8, NOTE_AS4,-8, NOTE_GS4,-8,
    NOTE_G4,8, NOTE_D4,8, NOTE_E4,-2  

  };

int tempo = 200;

int buzzer = 8;
int notes = sizeof(melody) / sizeof(melody[0]) / 2;
int wholenote = (60000 * 4) / tempo;
int beatDuration = 60000 / tempo;
int divider = 0, noteDuration = 0;
unsigned long lastBeatTime = 0;
int beatCount = 0; // Counter for beats: 0=LED1, 1=LED2, 2=LED3, 3=LED4

// BPM LEDs on pins 2-5 (PORTD bits 2-5)
#define BPM_PORT PORTD
#define BPM_DDR DDRD
#define BPM_PIN_MASK 0b00111100  // Bits 2-5 for pins 2-5

// Pitch LEDs on pins 9-11 (PORTB bits 1-3)
#define PITCH_PORT PORTB
#define PITCH_DDR DDRB
#define PITCH_PIN_MASK 0b00001110  // Bits 1-3 for pins 9-11

void setup() {
  // Set up BPM LEDs (pins 2-5 as outputs)
  BPM_DDR |= BPM_PIN_MASK;
  
  // Set up Pitch LEDs (pins 9-11 as outputs)
  PITCH_DDR |= PITCH_PIN_MASK;
  
  pinMode(buzzer, OUTPUT);
  
  lastBeatTime = millis();
  
  for (int i = 0; i < notes * 2; i = i + 2) {

    divider = melody[i + 1];
    if (divider > 0) {
      noteDuration = (wholenote) / divider;
    } else if (divider < 0) {
      noteDuration = (wholenote) / abs(divider);
      noteDuration *= 1.5;
    }

    tone(buzzer, melody[i], noteDuration * 0.9);
    
    updateLEDs(melody[i]);

    delay(noteDuration);

    noTone(buzzer);
  }
}

void loop() {
  updateLEDs(0);
}

void updateLEDs(int noteFreq) {
  // Update BPM counter LEDs (pins 2-5)
  unsigned long currentTime = millis();
  if (currentTime - lastBeatTime >= beatDuration) {
    beatCount = (beatCount + 1) & 0x03; // Cycle 0-3 using bitwise AND
    lastBeatTime = currentTime;
  }
  
  // BPM LED pattern (shift to pins 2-5)
  // beatCount 0 = pin 2, 1 = pin 3, 2 = pin 4, 3 = pin 5
  uint8_t bpmPattern = (1 << (beatCount + 2)); // Shift by (beatCount + 2) for pins 2-5
  
  // BPM LEDs on PORTD (pins 2-5)
  BPM_PORT = (BPM_PORT & ~BPM_PIN_MASK) | (bpmPattern & BPM_PIN_MASK);
  
  // Pitch LEDs on PORTB (pins 9-11)
  uint8_t pitchPattern = 0;
  if (noteFreq >= NOTE_G5) {
    pitchPattern = 0b00001110; // very high notes
  } else if (noteFreq >= NOTE_E5) {
    pitchPattern = 0b00001100; // high notes
  } else if (noteFreq >= NOTE_C5) {
    pitchPattern = 0b00001000; // mid notes
  } else if (noteFreq >= NOTE_G4) {
    pitchPattern = 0b00000100; // mid-low notes
  } else if (noteFreq > 0) {
    pitchPattern = 0b00000010; // low notes
  } else {
    pitchPattern = 0b00000000; // All off for rests
  }
  
  // Update Pitch LEDs on PORTB (pins 9-11)
  PITCH_PORT = (PITCH_PORT & ~PITCH_PIN_MASK) | (pitchPattern & PITCH_PIN_MASK);
}