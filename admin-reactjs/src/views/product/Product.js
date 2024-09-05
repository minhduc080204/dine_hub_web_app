import React, { useEffect } from 'react'
import $ from 'jquery'
import DataTable from 'datatables.net-bs5'
import { API_URL } from '../../config/index'
const Product = () => {
  useEffect(() => {
    $('#myTable').DataTable()
    return () => {
      $('#myTable').DataTable().destroy(true)
    }
  }, [])
  constructor(){
    super();
    this.productAPI = '${API_URL()}/products';
  }
  return (
    <table id="myTable" className="display">
      <thead>
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Year</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Inception</td>
          <td>2010</td>
        </tr>
        <tr>
          <td>2</td>
          <td>Interstellar</td>
          <td>2014</td>
        </tr>
      </tbody>
    </table>
  )
}

export default Product
