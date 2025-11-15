def main():
  inventory = {} # dictionary
  items = [] # list 

  display_menu()

  while True:
    try:
      choice = input("Choice: ")
      match choice:
        case "1":
          add_item(inventory, items)
        case "2":
          update_price(inventory, items)
        case "3":
          view_inventory(inventory, items)
        case "4":
          print("Exiting the program...")
          break
        case _:
          print("Invalid choice. Please try again.")
    except Exception as e:
      print(f"An unexpected error occurred: {e}")

def display_menu():
  print("# ---------------------------------------------------------------------------- #")
  print("#                             Inventory System Menu                            #")
  print("# ---------------------------------------------------------------------------- #")
  print("[1] Add Item")
  print("[2] Update Price")
  print("[3] View Inventory")
  print("[4] Exit")

def add_item(inventory, items):
  try:
    name = input("Enter item name: ")
    price = float(input("Enter item price: "))
    inventory[name] = price
    items.append(name)
    print(f"Item '{name}' added with price {price}.\n")
  except ValueError:
    print("Invalid input. Please enter a valid price.\n")
  except Exception as e:
    print(f"An error occurred: {e}")

def update_price(inventory, items):
  try:
    name = input("Enter item name to update: ")
    if name in items:
      new_price = float(input("Enter new price: "))
      inventory[name] = new_price
      print(f"Item '{name}' updated to new price {new_price}.\n")
    else:
      print(f"Item '{name}' not found in inventory.\n")
  except ValueError:
    print("Invalid input. Please enter a valid price.\n")
  except Exception as e:
    print(f"An error occurred: {e}")

def view_inventory(inventory, items):
  if inventory and items:
    print("(Dictionary) Current Inventory:")
    for name, price in inventory.items():
      print(f"- {name}: ₱{price:.2f}")
      
    print("\n(List) Current Item Names:")
    for item in items:
      print(f"- {item}")
    print()
  else:
    print("Inventory is empty.\n")

if __name__ == "__main__":
  main()