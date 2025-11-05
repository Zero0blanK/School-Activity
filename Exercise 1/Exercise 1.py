class Dog:
  def __init__(self, name, age):
      self.name = name
      self.age = age

  def bark(self):
      return f"Woof! Woof!"

  def getInfo(self):
      return f"Dog name: {self.name}, Age: {self.age} years old."
  
  def celebrateBirthday(self):
      self.age += 1
      return f"Happy Birthday! {self.name} is now {self.age} years old."

myDog = Dog("Happy", 5)
print(myDog.bark())
print(myDog.getInfo())
print(myDog.celebrateBirthday())