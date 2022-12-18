// Store the current date and time
var current_date = new Date()

// Store the date of the next New Year's Day
var new_years_date = new Date()
new_years_date.setYear(new_years_date.getFullYear() + 1)
new_years_date.setMonth(0)
new_years_date.setDate(1)

// Call the days_between function
var days_left = days_between(current_date, new_years_date)

// Write the result to the page
if (days_left > 1) {
  document.write("About " + days_left + " days left 'till the next year...")
}
else {
  document.write("About " + days_left + " day left 'till the next year...")
}