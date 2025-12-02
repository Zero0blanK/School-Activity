class BankAccount:
  def __init__(self, name, account_number, balance=0):
    self.name = name
    self.account_number = account_number
    self.balance = balance
    print(f"\nAccount created successfully!")
    print(f"Account Name: {self.name}")
    print(f"Account Number: {self.account_number}")
    print(f"Initial Balance: ₱{self.balance:.2f}")
  
  def deposit(self, amount):
    if amount <= 0:
      print("\nDeposit amount must be positive!")
      return False

    if amount > 0:
      self.balance += amount
      print(f"\nDeposited: ₱{amount:.2f}")
      print(f"New Balance: ₱{self.balance:.2f}")
      return True
  
  def withdraw(self, amount):
    if amount <= 0:
      print("\nWithdrawal amount must be positive!")
      return False
    
    if amount > self.balance:
      print(f"\nInsufficient funds!")
      print(f"Requested: ₱{amount:.2f}")
      print(f"Available Balance: ₱{self.balance:.2f}")
      return False
    else:
      self.balance -= amount
      print(f"\n✓ Withdrawn: ₱{amount:.2f}")
      print(f"New Balance: ₱{self.balance:.2f}")
      return True
  
  def show_balance(self):
    print(f"\n{'='*50}")
    print(f"Account Holder: {self.name}")
    print(f"Account Number: {self.account_number}")
    print(f"Current Balance: ₱{self.balance:.2f}")
    print(f"{'='*50}")
    return self.balance
  
  def withdraw_with_fee(self, amount, fee=15):
    if amount <= 0:
      print("\nWithdrawal amount must be positive!")
      return False
    
    total_withdrawal = amount + fee
    
    if total_withdrawal > self.balance:
      print(f"\nInsufficient funds!")
      print(f"Amount requested: ₱{amount:.2f}")
      print(f"Transaction fee: ₱{fee:.2f}")
      print(f"Total needed: ₱{total_withdrawal:.2f}")
      print(f"Available Balance: ₱{self.balance:.2f}")
      return False
    else:
      self.balance -= total_withdrawal
      print(f"\n✓ Withdrawal with fee processed:")
      print(f"Amount withdrawn: ₱{amount:.2f}")
      print(f"Transaction fee: ₱{fee:.2f}")
      print(f"Total deducted: ₱{total_withdrawal:.2f}")
      print(f"New Balance: ₱{self.balance:.2f}")
      return True
