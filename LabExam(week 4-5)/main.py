import BankAccount as ba

def main():
  print("="*50)
  print("        WELCOME TO BANK ACCOUNT SIMULATOR")
  print("="*50)
  
  # create a new account
  print("\n--- Create New Account ---")
  acc_name = input("Enter account holder name: ")
  acc_number = input("Enter account number: ")

  account = ba.BankAccount(acc_name, acc_number)
  # main menu loop
  while True:
    print("\n" + "="*50)
    print(" "*21 + "MAIN MENU")
    print("="*50)
    print("1. Deposit Money")
    print("2. Withdraw Money")
    print("3. Withdraw with Fee")
    print("4. Check Balance")
    print("5. Exit")
    print("="*50)
    
    choice = input("\nEnter your choice (1-5): ")
    
    match choice:
      # Deposit Money
      case '1':
        try:
          amount = float(input("\nEnter amount to deposit: "))
          account.deposit(amount)
        except ValueError:
          print("\nPlease enter a valid number!")
      # Withdraw Money
      case '2':
        try:
          amount = float(input("\nEnter amount to withdraw: "))
          account.withdraw(amount)
        except ValueError:
          print("\nPlease enter a valid number!")
      # Withdraw with Fee
      case '3':
        try:
          amount = float(input("\nEnter amount to withdraw: "))
          account.withdraw_with_fee(amount)
        except ValueError:
          print("\nPlease enter valid numbers!")
      # Check Balance
      case '4':
        account.show_balance()
      # Exit
      case '5':
        print("\n" + "="*50)
        print("   Thank you for using Bank Account Simulator!")
        print("="*50)
        break
      # Invalid Choice
      case _:
        print("\nInvalid choice! Please select 1-5.")


if __name__ == "__main__":
  main()