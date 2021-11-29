  const url = "http://localhost:888/matics2/api/v1"  

  const req = async (parm) => {
    const response = await fetch(`${url}${parm}`)
    return await response.json()
}
